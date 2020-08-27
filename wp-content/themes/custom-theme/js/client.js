jQuery(document).ready(function($){
	setTimeout(function(){
		$('.tabs').tabslet();
	}, 1000, true);

	$('.doc').lightGallery({
    	selector: 'this',
    	iframeMaxWidth: '80%',
		download: false,
		counter: false
	});

	$('.plan-list li.list-title').click(function(){
		$(this).toggleClass('active');
		$(this).next('.sub').slideToggle();
	});

	$('.score-wrap .cell.variation.hover1').on('hover', function () {
		$(this).toggleClass('show');
	});

	$('.score-wrap .cell.variation.hover').on('click', function () {
		$('body').addClass('show-overlay');
		$(this).toggleClass('show');
	});

	$('.overlay').on('click', function () {
		$('body').removeClass('show-overlay');
		$('.score-wrap .cell.variation.hover').removeClass('show');
	});

	// mixitup start

	var container = document.querySelector('.tab > ul');
	var inputSearch = document.querySelector('[data-ref="search-input"]');
	var keyupTimeout;

	if(container){
		mixer = mixitup(container, {
			animation: {
				duration: 350
			}
		});

		$('.tabs').on('_before', function() {
			if (typeof mixer !== 'undefined') {
				mixer.destroy();
			}
		});

		$('.tabs').on('_after', function() {
			$('.custom-search input').val('');
			$('.tab').removeClass('active');
			$('.tab[style*="display: block"]').addClass('active');

			if($('.active > ul').length) {
				mixer = mixitup('.active > ul', {
					animation: {
						duration: 350
					}
				});
			}
		});
	}

	// Set up a handler to listen for "keyup" events from the search input

	inputSearch.addEventListener('keyup', function() {
		var searchValue;

		$('.active .plan-list .sub').show();

		if (inputSearch.value.length < 3) {
			// If the input value is less than 3 characters, don't send
			searchValue = '';
		} else {
			searchValue = inputSearch.value.toLowerCase().trim();
		}

		// Very basic throttling to prevent mixer thrashing. Only search
		// once 350ms has passed since the last keyup event

		clearTimeout(keyupTimeout);

		keyupTimeout = setTimeout(function() {
			filterByString(searchValue);
		}, 350);
	});

	/**
	 * Filters the mixer using a provided search string, which is matched against
	 * the contents of each target's "class" attribute. Any custom data-attribute(s)
	 * could also be used.
	 *
	 * @param  {string} searchValue
	 * @return {void}
	 */

	function filterByString(searchValue) {
		if (searchValue) {
			// Use an attribute wildcard selector to check for matches

			mixer.filter('[class*="' + searchValue + '"]');
		} else {
			// If no searchValue, treat as filter('all')

			mixer.filter('all');
		}
	}

	/* Tasks */

	var siteURL = 'http://www.littlefishproperties.com.au';

	Dropzone.options.myAwesomeDropzone = {
		maxFilesize: 1,
		addRemoveLinks: true,
		dictResponseError: 'Server not Configured',
		//acceptedFiles: ".doc,.pdf,.docx",
		init:function(){
			var self = this;
			// config
			self.options.addRemoveLinks = true;
			self.options.dictRemoveFile = "Delete";
			//New file added
			self.on("addedfile", function (file) {
				console.log('new file added ', file);
			});
			// Send file starts
			self.on("sending", function (file) {
				console.log('upload started', file);
				$('.meter').show();
			});

			// File upload Progress
			self.on("totaluploadprogress", function (progress) {
			console.log("progress ", progress);
				$('.roller').width(progress + '%');
			});

			self.on("queuecomplete", function (progress) {

				$('.meter').delay(999).slideUp(999);
			});

			// On removing file
			self.on("removedfile", function (file) {
				console.log(file);
			});
		}
	};

	$('.purpuleDownList .manualSign').click(function(e){
		var clickedthis = $(this);
		var ua = window.navigator.userAgent;
		var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
		var webkit = !!ua.match(/WebKit/i);
		var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
		if(iOS === true && webkit === true && iOSSafari === true){
			e.preventDefault();
			var metaId = $(this).attr('meta-data');
			var userId = $(this).attr('meta-user-id');
			var fileName = $(this).attr('file-name');
			$('.uploadDragnDrop form input#meta_id').val(metaId);
			$('.uploadDragnDrop').addClass('purpleForm');
			$('.uploadDragnDrop').removeClass('greydrop');
			$('.uploadDragnDrop.purpleForm .dropzone').css('background-color','#d9d3eb');
			$('.uploadDragnDrop form div.dz-message .dzMidleCont').html('<i class="dropIcon"></i><p class="coloredText"><strong>Important:</strong> Please only upload this file; </p> <p class="coloredText">"'+fileName+'"</p><p>* All other files can be uploaded after you have uploaded the requested file.</p>');

			var ajaxurl = $('.adminAjax').val();
			$.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "last_uploaded", metaId : metaId, userId : userId},
				success: function(response) {
					var imgUrl = clickedthis.attr('href');

					if($('.leftUpload .uploadDragnDrop').hasClass('purpleForm')){
						$('.tabs ul li.active a').removeAttr('class');
						$('.tabs ul li.active a').attr('class','tabpurple');
					} else if($('.leftUpload .taskDownloadList li').length > 0){
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('purpuleDownList')) {
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabpurple');
						}
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('BlueDownList')) {
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabblue');
						}
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('greenDownList')) {
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabgreen');
						}
					} else {
						$('.tabs ul li.active a').removeAttr('class');
					}
					$(this).closest("li").remove();
					localStorage.setItem('task_reload', true);
					//~ document.location = imgUrl;
					setTimeout(function(){
						location.href = imgUrl;
					}, 1000);
				}
			});

			$(this).closest("li").remove();

		}else{
			var metaId = $(this).attr('meta-data');
			var userId = $(this).attr('meta-user-id');
			var fileName = $(this).attr('file-name');
			$('.uploadDragnDrop form input#meta_id').val(metaId);
			$('.uploadDragnDrop').addClass('purpleForm');
			$('.uploadDragnDrop').removeClass('greydrop');
			$('.uploadDragnDrop.purpleForm .dropzone').css('background-color','#d9d3eb');
			$('.uploadDragnDrop form div.dz-message .dzMidleCont').html('<i class="dropIcon"></i><p class="coloredText"><strong>Important:</strong> Please only upload this file; </p> <p class="coloredText">"'+fileName+'"</p><p>* All other files can be uploaded after you have uploaded the requested file.</p>');


			var ajaxurl = $('.adminAjax').val();
			$.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "last_uploaded", metaId : metaId, userId : userId},
				success: function(response) {
				}
			});

			$(this).closest("li").remove();
		}
	});

	$('.tabs.tabs_default ul.horizontal li a').on('click', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	//~ if(activeTab === 'undefined' || activeTab == '' || activeTab === null) { } else {
		if($( ".tabs.tabs_default ul.horizontal li a" ).hasClass( "tabgreen" ) || $( ".tabs.tabs_default ul.horizontal li a" ).hasClass( "tabpurple" ) || $( ".tabs.tabs_default ul.horizontal li a" ).hasClass( "tabblue" )){
		//~ if($( ".tabs.tabs_default ul.horizontal li a" ).hasClass( "tabblue" )){

			setTimeout(function() {
				$('.tabs.tabs_default ul.horizontal li').removeClass('active');
				$('.tab').css('display','none');
				//~ $(activeTab+'.tab').css('display','block');
				$('#tab-4.tab').css('display','block');
				//~ $('.tabs.tabs_default ul li a[href="' + activeTab + '"]').parent('li').addClass('active');
				$('.tabs.tabs_default ul li a[href="#tab-4"]').parent('li').addClass('active');
			}, 1500)
		}

	//~ }

	//~ if(window.location.href.indexOf("document-uploaded") > -1 || window.location.href.indexOf("action-completed") > -1 || window.location.href.indexOf("action-required") > -1 || window.location.href.indexOf("request-completed") > -1 || window.location.href.indexOf("file-uploaded") > -1) {
	if(window.location.href.indexOf("document-uploaded") > -1 || window.location.href.indexOf("action-required") > -1 || window.location.href.indexOf("request-completed") > -1 || window.location.href.indexOf("file-uploaded") > -1 || window.location.href.indexOf("tab-4") > -1) {
		setTimeout(function() {
			$('.tabs.tabs_default ul.horizontal li').removeClass('active');
			$('.tab').css('display','none');
			$('#tab-4.tab').css('display','block');
			$('.tabs.tabs_default ul li a[href="#tab-4"]').parent('li').addClass('active');
		}, 1500);
	} else {
		var reload_from_tasks = localStorage.getItem('reload_from_tasks_page');
		if(reload_from_tasks !== null && reload_from_tasks !== false && reload_from_tasks !== undefined && reload_from_tasks !== 'undefined' && reload_from_tasks !== ''){
			setTimeout(function() {
				$('.tabs.tabs_default ul.horizontal li').removeClass('active');
				$('.tab').css('display','none');
				$('#tab-4.tab').css('display','block');
				$('.tabs.tabs_default ul li a[href="#tab-4"]').parent('li').addClass('active');
				localStorage.setItem('reload_from_tasks_page', '');
			}, 1500);
		}
	}

	$('.BlueDownList').click(function(e){
		//~ alert('clicked');
		var clickedthis = $(this);
		var ua = window.navigator.userAgent;
		var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
		var webkit = !!ua.match(/WebKit/i);
		var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
		//~ alert(iOS+'----'+webkit+'----'+iOSSafari);
		if(iOS === true && webkit === true && iOSSafari === true){
			//~ alert('138');
			e.preventDefault();
			var metaId = $(this).attr('metaid');
			var postId = $(this).attr('postId');
			var ajaxurl = $('.adminAjax').val();
			$.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "downloaded_files", metaId : metaId, postId : postId},
				success: function(response) {
					//~ alert('149');
					var imgUrl = clickedthis.find('a').attr('href');
					if($('.leftUpload .uploadDragnDrop').hasClass('purpleForm')){
						//~ alert('if1');
						$('.tabs ul li.active a').removeAttr('class');
						$('.tabs ul li.active a').attr('class','tabpurple');
					} else if($('.leftUpload .taskDownloadList li').length > 0){
						//~ alert('if2');
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('purpuleDownList')) {
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabpurple');
						}
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('BlueDownList')) {
							//~ alert('if3');
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabblue');
						}
						if($('.leftUpload .taskDownloadList li').eq(-1).hasClass('greenDownList')) {
							//~ alert('if4');
							$('.tabs ul li.active a').removeAttr('class');
							$('.tabs ul li.active a').attr('class','tabgreen');
						}
					} else {
						//~ alert('else');
						$('.leftUpload ul.taskDownloadList').append('<li class="GreyDownList noDownloads"><a href="javascript:void(0);" class="taskURL"><i class="TaskIcons downloadActionBtn announceIcon"></i><span>You\'re awesome, you have no task to complete</span></a></li>');
						$('.tabs.tabs_default ul li.active a').removeAttr('class');
						//~ alert('else1');
					}
					//~ alert('177');
					//window.location.assign(imgUrl);
					//	location.href=imgUrl;
					//~ window.location.href = imgUrl;
					localStorage.setItem('task_reload', true);
					//~ document.location = imgUrl;
					setTimeout(function(){
						location.href = imgUrl;
					 }, 1000);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//~ alert('error');
					alert("Status: " + textStatus); alert("Error: " + errorThrown);
				}
			});
			//~ alert('190');
			$(this).closest("li").remove();

			//~ setTimeout(function(){
				//~ localStorage.setItem('reload_from_tasks_page', 'tab4');
				//~ location.reload();
			//~ },500);
			return false;
		} else {
			var metaId = $(this).attr('metaid');
			var postId = $(this).attr('postId');

			var ajaxurl = $('.adminAjax').val();
			$.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "downloaded_files", metaId : metaId, postId : postId},
				success: function(response) {}
			});

			$(this).closest("li").remove();
			setTimeout(function(){
				localStorage.setItem('reload_from_tasks_page', 'tab4');
				location.reload();
			},500);

			return true;
		}

	});

	//~ window.onhashchange = function() {
		//~ alert('Hiii');
		//~ window.location.reload();
	//~ }

	$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
	var metaId = '';
	var fileType = '';

	$(".signhere").click(function(e){
		var clientid = $(this).attr('data-clientid');
		var fileurl = $(this).attr('data-filepath');
		metaId = $(this).attr('meta-id');
		fileType = $(this).attr('file-type');
		fileType2 = $(this).attr('data-filetype');
		$("#btnSaveSign").attr('data-filepath',fileurl);
		$("#btnSaveSign").attr('data-filetype',fileType2);
		//alert(fileurl);
		$("#displaysignform").toggle();
	});

	$("#btnSaveSign").click(function(e){
		var filepath = $(this).attr('data-filepath');
		var datafiletype = $(this).attr('data-filetype');
		var userId = $('.main-container').attr(data-user-id);
		var post_id = $('.main-container').attr(data-post-id);

		html2canvas([document.getElementById('sign-pad')], {
			onrendered: function (canvas) {
				var canvas_img_data = canvas.toDataURL('image/png');
				var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
				//ajax call to save image inside folder
				if(datafiletype == 'doc_file'){
					$.ajax({
						url: siteURL + '/save_sign_doc.php',
						data: { img_data:img_data,filepath:filepath,userId:userId,post_id:post_id,metaId:metaId,fileType:fileType },
						type: 'post',
						dataType: 'json',
						success: function (response) {
							console.log(response);
							// if(response == 0){
								// alert('Error in signing doc. Please try again.');
							// } else {
								// $("#displaysignform").hide();
								// alert('Doc signed successfully');
								// location. reload(true);
							// }
						}
					});
				}else{
					$.ajax({
						url: siteURL + '/save_sign.php',
						data: { img_data:img_data,filepath:filepath,userId:userId,post_id:post_id,metaId:metaId,fileType:fileType },
						type: 'post',
						dataType: 'json',
						success: function (response) {
							console.log(response);
							if(response == 0){
								alert('Error in signing doc. Please try again.');
							} else {
								$("#displaysignform").hide();
								alert('Doc signed successfully');
								location. reload(true);
							}
						}
					});
				}
			}
		});
	});
});

//~ function alertFunction(metaId){
	//~ var ajaxurl = $('.adminAjax').val();
	//~ var postId = $('li.meta'+metaId).attr('postId');
	//~ var fileURL = $('li.meta'+metaId+' a').attr('data-url');

	//~ $.ajax({
		//~ type : "post",
		//~ dataType : "json",
		//~ url : ajaxurl,
		//~ data : {action: "downloaded_files", metaId : metaId, postId : postId},
		//~ success: function(response) {
			//~ localStorage.setItem('reload_from_tasks_page', 'tab4');
			//~ $('li.meta'+metaId).remove();
			//~ setTimeout(function(){
				//~ window.location.href= fileURL;
			//~ },500);
		//~ }
	//~ });
//~ }

(function()
{
  if( window.localStorage )
  {
    //~ if( !localStorage.getItem('firstLoad') )
    //~ {
      //~ localStorage['firstLoad'] = true;
      //~ window.location.reload();
    //~ }
    //~ else
    //~ {
      //~ localStorage.removeItem('firstLoad');
	//~ }
    if( localStorage.getItem('task_reload') )
    {
		//~ alert('reloading');
		localStorage.setItem('reload_from_tasks_page', 'tab4');
		localStorage.removeItem('task_reload');
		window.location.reload();
    }
    //~ else
    //~ {
      //~ localStorage.removeItem('firstLoad');
	//~ }
  }
})();
