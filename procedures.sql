DELIMITER $$
CREATE  PROCEDURE
`Xero_ProcessOnExpense`(
IN `OptionType` VARCHAR(50),
IN `QueryBankTransaction` TEXT,
IN `QueryLineItem` TEXT,
IN `QueryTracking` TEXT,
IN `QueryContact` TEXT)
    NO SQL
BEGIN
	IF(OptionType = 'INSERT')  THEN
    
		DROP TEMPORARY TABLE IF EXISTS Temp;
        DROP TEMPORARY TABLE IF EXISTS TempLineItem;
        DROP TEMPORARY TABLE IF EXISTS TempTracking;
        DROP TEMPORARY TABLE IF EXISTS TempContact;
        
        -- Bank Transaction 
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp
		(
            BankTransactionID varchar(100),Reference varchar(45),SubTotal double 
			,Total double,Date datetime,UpdatedDateUTC datetime,ContactID varchar(100),IsReconciled bit(1),
            Type varchar(45),AccountName varchar(255)
        );
        
        if QueryBankTransaction <> '' then
			SET @SQLBankTransaction := QueryBankTransaction;
			PREPARE stmtBankTransaction FROM @SQLBankTransaction;
			execute stmtBankTransaction;
			DEALLOCATE PREPARE stmtBankTransaction;
        end if;
         
        -- Line Item 
        CREATE TEMPORARY TABLE IF NOT EXISTS TempLineItem
		(
			BankTransactionID varchar(100),ItemCode varchar(150) ,Description longtext ,UnitAmount double,
			TaxAmount double ,LineAmount double ,AccountCode varchar(45),
			Quantity double ,LineItemID varchar(100)
        );
        
        
        if QueryLineItem <> '' then
			SET @SQLLineItem := QueryLineItem;
			PREPARE stmtLineItem FROM @SQLLineItem;
			execute stmtLineItem;
			DEALLOCATE PREPARE stmtLineItem;
		end if;
        
        -- Tracking
        CREATE TEMPORARY TABLE IF NOT EXISTS TempTracking
		(
        LineItemID varchar(100),`Option` varchar(150),
        TrackingOptionID varchar(100)
        );
        
		if QueryTracking <> '' then
			SET @SQLTracking := QueryTracking;
			PREPARE stmtTracking FROM @SQLTracking;
			execute stmtTracking;
			DEALLOCATE PREPARE stmtTracking;
		end if;
        
        -- Contact
        CREATE TEMPORARY TABLE IF NOT EXISTS TempContact
		(
			ContactID varchar(100) ,Name varchar(255) ,FirstName varchar(255) ,
			LastName varchar(255) ,IsSupplier bit(1) ,IsCustomer bit(1)
        );
        
        
		if QueryTracking <> '' then
			SET @SQLContact := QueryContact;
			PREPARE stmtContact FROM @SQLContact;
			execute stmtContact;
			DEALLOCATE PREPARE stmtContact;
        end if;
        
        -- Insert contacts
        INSERT INTO xero_contact (ContactID,Name,FirstName,
			LastName,IsSupplier,IsCustomer)
        SELECT 
			T.ContactID,T.Name,T.FirstName,T.
			LastName,T.IsSupplier,T.IsCustomer
		FROM TempContact T
        ON DUPLICATE KEY UPDATE Name = T.Name,FirstName = T.FirstName,LastName = T.LastName,
        IsSupplier = T.IsSupplier,IsCustomer = T.IsCustomer,UpdatedDate = NOW();
           
        -- Insert expense  
        INSERT INTO xero_expense (BankTransactionID,Reference,SubTotal,
				Total,Date,UpdatedDateUTC,ContactID,IsReconciled,Type,AccountName)
        SELECT 
			T.BankTransactionID,T.Reference,T.SubTotal,T.
			Total,T.Date,T.UpdatedDateUTC,T.ContactID,T.IsReconciled,T.Type,T.AccountName
		FROM Temp T
        ON DUPLICATE KEY UPDATE SubTotal = T.SubTotal,Total = T.Total,
        Date = T.Date,Reference = T.Reference,AccountName = T.AccountName,IsReconciled = T.IsReconciled,
        Type = T.Type,UpdatedDateUTC = T.UpdatedDateUTC,ContactID = T.ContactID,UpdatedDate = NOW();
        
        -- Insert Line Item
        INSERT INTO xero_expense_lineitem (BankTransactionID,ItemCode,Description,UnitAmount,
			TaxAmount,LineAmount,AccountCode,
			Quantity,LineItemID)
        SELECT 
			 T.BankTransactionID,T.ItemCode,T.Description,T.UnitAmount,
			T.TaxAmount,T.LineAmount,T.AccountCode,
            T.Quantity,T.LineItemID
		FROM TempLineItem T
        ON DUPLICATE KEY UPDATE BankTransactionID = T.BankTransactionID,ItemCode = T.ItemCode,
        Description = T.Description,UnitAmount = T.UnitAmount,TaxAmount = T.TaxAmount,
        LineAmount = T.LineAmount,AccountCode = T.AccountCode,Quantity = T.Quantity;
        
        -- Insert Tracking
		INSERT INTO xero_expense_item_tracking (LineItemID,`Option`,TrackingOptionID)
		SELECT 
			 T.LineItemID,T.Option,T.TrackingOptionID
		FROM TempTracking T WHERE T.LineItemID is not null
		ON DUPLICATE KEY UPDATE `Option` = T.Option;
        
		SELECT 1 AS Result;
        
		DROP TEMPORARY TABLE IF EXISTS Temp;
        DROP TEMPORARY TABLE IF EXISTS TempLineItem;
        DROP TEMPORARY TABLE IF EXISTS TempTracking;
        DROP TEMPORARY TABLE IF EXISTS TempContact;
        
	ELSEIF (OptionType = 'SELECT') THEN
    
		SELECT B.* FROM xero_expense B;
        
         SELECT C.* FROM xero_contact AS C
        JOIN xero_expense AS B ON C.ContactID = B.ContactID;
         
        SELECT L.* FROM xero_expense AS B
        JOIN xero_expense_lineitem AS L ON L.BankTransactionID = B.BankTransactionID;
         
        SELECT T.* FROM xero_expense AS B
        JOIN xero_expense_lineitem AS L ON L.BankTransactionID = B.BankTransactionID
        JOIN xero_expense_item_tracking AS T ON T.LineItemID = L.LineItemID;
	ELSEIF (OptionType = 'SELECTLASTMODIFYDATE') THEN
		SELECT max(UpdatedDateUTC) FROM xero_expense;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnBankFeed`(
IN `OptionType` VARCHAR(50),
IN `QueryBankFeed` TEXT)
    NO SQL
BEGIN
	IF(OptionType = 'INSERT')  THEN
    
		DROP TEMPORARY TABLE IF EXISTS Temp;
        
        -- Bank Transaction 
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp
		(
            Description text,Reference varchar(45) ,Reconciled varchar(45) ,Source varchar(45) 
			,Amount double ,Balance double ,Date varchar(45)
        );
        
		if QueryBankFeed <> '' then
			SET @SQLBankFeed := QueryBankFeed;
			PREPARE stmtBankFeed FROM @SQLBankFeed;
			execute stmtBankFeed;
			DEALLOCATE PREPARE stmtBankFeed;
        end if;
        
        -- Insert expense  
        INSERT INTO xero_bank_feed (Description,Reference,Reconciled,Source,
				Amount,Balance,Date)
        SELECT 
			T.Description,T.Reference,T.Reconciled,T.Source,T.
				Amount,T.Balance,T.Date
		FROM Temp T
        ON DUPLICATE KEY UPDATE Description = T.Description,Reference = T.Reference,
        Reconciled = T.Reconciled,Source = T.Source,Amount = T.Amount
        ,Balance = T.Balance,UpdatedDate = NOW();
        
		SELECT 1 AS Result;
        
		DROP TEMPORARY TABLE IF EXISTS Temp;
        
	ELSEIF (OptionType = 'SELECT') THEN
    
		SELECT B.* FROM xero_bank_feed B;
	ELSEIF (OptionType = 'SELECTLASTMODIFYDATE') THEN
		SELECT max(UpdatedDate) FROM xero_bank_feed;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnAccounts`(
IN `OptionType` VARCHAR(50),
IN `QueryAccount` TEXT)
    NO SQL
BEGIN
	IF(OptionType = 'INSERT')  THEN
		DROP TEMPORARY TABLE IF EXISTS Temp;
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp
		(
        `AccountID` VARCHAR(100),`Code` VARCHAR(45),`Name` VARCHAR(255),`Status` bit
        );
        
        if QueryAccount <> '' then
			SET @SQLAccount := QueryAccount;
			PREPARE stmtAccount FROM @SQLAccount;
			execute stmtAccount;
			DEALLOCATE PREPARE stmtAccount;
        end if;
        
        INSERT INTO xero_accounts (AccountID,Code, Name, Status)
        SELECT 
				T.AccountID,T.Code, T.Name, T.Status
		FROM Temp T
        ON DUPLICATE KEY UPDATE Code = T.Code,Name = T.Name,Status = T.Status,UpdatedDate = NOW();
        
		SELECT 1 AS Result;
        DROP TEMPORARY TABLE IF EXISTS Temp;
        
	ELSEIF (OptionType = 'SELECT') THEN
		SELECT * FROM xero_accounts;
	ELSEIF (OptionType = 'SELECTLASTMODIFYDATE') THEN
		SELECT max(UpdatedDate) FROM xero_accounts;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnLogger`(
IN `ShortMessage` TEXT,
IN `FullMessage` TEXT,
IN `MethodName` VARCHAR(45),
IN `LineNumber` VARCHAR(45),
IN `IPAddress` VARCHAR(45))
    NO SQL
BEGIN

    INSERT INTO xero_logger (
		ShortMessage,FullMessage,MethodName,
		LineNumber,IPAddress)
   values (ShortMessage,FullMessage,MethodName,
		LineNumber,IPAddress);
    
    SELECT 1 AS RESULT;
    DROP TEMPORARY TABLE IF EXISTS Temp;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnSettings`(
IN `OptionType` VARCHAR(50),
IN `Email` VARCHAR(50),
IN `Password` VARCHAR(50),
IN `AccessToken` VARCHAR(100))
    NO SQL
BEGIN
    IF(OptionType = 'SELECT')  THEN
        SELECT U.* FROM xero_settings U WHERE U.Email = Email AND U.Password = `Password` limit 1;
    ELSEIF (OptionType = 'SELECTBYID') THEN
        SELECT * FROM xero_settings U WHERE U.AccessToken = AccessToken limit 1;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnTenants`(
IN `OptionType` VARCHAR(50),
IN `QueryTenant` TEXT)
    NO SQL
BEGIN
	IF(OptionType = 'INSERT')  THEN
    
		DROP TEMPORARY TABLE IF EXISTS Temp;
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp
		(
        `id` VARCHAR(100),`tenantId` VARCHAR(100),`tenantType` VARCHAR(100),`tenantName` VARCHAR(255)
        );
        
        if QueryTenant <> '' then
			SET @SQLTenant := QueryTenant;
			PREPARE stmtTenant FROM @SQLTenant;
			execute stmtTenant;
			DEALLOCATE PREPARE stmtTenant;
        end if;
        
        INSERT INTO xero_tenants (id,tenantId, tenantType, tenantName)
        SELECT 
				T.id,T.tenantId, T.tenantType, T.tenantName
		FROM Temp T
        ON DUPLICATE KEY UPDATE tenantName = T.tenantName,UpdatedDate = NOW();
        
		SELECT 1 AS Result;
        DROP TEMPORARY TABLE IF EXISTS Temp;
        
	ELSEIF (OptionType = 'SELECT') THEN
		SELECT * FROM xero_tenants;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Xero_ProcessOnToken`(
IN `OptionType` VARCHAR(50),
IN `InputJson` TEXT)
    NO SQL
BEGIN
	IF(OptionType = 'INSERT')  THEN
    
		DROP TEMPORARY TABLE IF EXISTS Temp;
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp
		(
        `scope` TEXT,`id_token` TEXT,`expires_in` VARCHAR(45),`token_type` VARCHAR(45),
        `access_token` TEXT,`refresh_token` TEXT,`client_id` VARCHAR(150),
        `client_secreat` VARCHAR(150),`expires_datetime` datetime
        );
        
        if InputJson <> '' then
			SET @SQL := InputJson;
			PREPARE stmt FROM @SQL;
			execute stmt;
			DEALLOCATE PREPARE stmt;
		end if;
        
         IF EXISTS (select * from xero_token limit 1) THEN
			update xero_token AS S,Temp AS T 
				set S.expires_in = T.expires_in, S.access_token = T.access_token, 
					S.refresh_token = T.refresh_token, S.updated_date = NOW()
                    ,S.expires_datetime = T.expires_datetime;
       ELSE 
			insert into xero_token (scope, id_token, expires_in, token_type,access_token,refresh_token,
				client_id,client_secreat,expires_datetime)
			SELECT 
				J.scope, J.id_token, J.expires_in, J.token_type,J.access_token,
				J.refresh_token,J.client_id,J.client_secreat,J.expires_datetime
			FROM Temp J;
		END IF;
        
		SELECT 1 AS Result;
        DROP TEMPORARY TABLE IF EXISTS Temp;
        
	ELSEIF (OptionType = 'SELECT') THEN
		SELECT * FROM xero_token limit 1;
	ELSEIF (OptionType = 'DELETE') THEN
		DELETE FROM xero_token;
		SELECT 1 AS Result;
    END IF;
END$$
DELIMITER ;
