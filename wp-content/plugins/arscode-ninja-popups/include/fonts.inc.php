<?php

function snp_get_animations($type = null)
{
    $animations = array();
    $animations['attention_seekers'] = array(
        'label' => 'Attention Seekers',
        'animations' => array(
            'bounce',
            'flash',
            'pulse',
            'rubberBand',
            'shake',
            'swing',
            'tada',
            'wobble'
        )
    );
    $animations['bouncing_entrances'] = array(
        'label' => 'Bouncing Entrances', 
        'animations' => array(
            'bounceIn',
            'bounceInDown',
            'bounceInLeft',
            'bounceInRight',
            'bounceInUp',
        ));

    $animations['bouncing_exits'] = array(
        'label' => 'Bouncing Exits', 
        'animations' => array(
            'bounceOut',
            'bounceOutDown',
            'bounceOutLeft',
            'bounceOutRight',
            'bounceOutUp',
        ));

    $animations['fading_entrances'] = array(
        'label' => 'Fading Entrances', 
        'animations' => array(
            'fadeIn',
            'fadeInDown',
            'fadeInDownBig',
            'fadeInLeft',
            'fadeInLeftBig',
            'fadeInRight',
            'fadeInRightBig',
            'fadeInUp',
            'fadeInUpBig',
        ));

    $animations['fading_exits'] = array(
        'label' => 'Fading Exits', 
        'animations' => array(
            'fadeOut',
            'fadeOutDown',
            'fadeOutDownBig',
            'fadeOutLeft',
            'fadeOutLeftBig',
            'fadeOutRight',
            'fadeOutRightBig',
            'fadeOutUp',
            'fadeOutUpBig',
        ));

    $animations['flippers'] = array(
        'label' => 'Flippers', 
        'animations' => array(
            'flip',
            'flipInX',
            'flipInY',
            'flipOutX',
            'flipOutY',
        ));

    $animations['lightspeed'] = array(
        'label' => 'Lightspeed', 
        'animations' => array(
            'lightSpeedIn',
            'lightSpeedOut',
        ));

    $animations['rotating_entrances'] = array(
        'label' => 'Rotating Entrances', 
        'animations' => array(
            'rotateIn',
            'rotateInDownLeft',
            'rotateInDownRight',
            'rotateInUpLeft',
            'rotateInUpRight',
        ));

    $animations['rotating_exits'] = array(
        'label' => 'Rotating Exits', 
        'animations' => array(
            'rotateOut',
            'rotateOutDownLeft',
            'rotateOutDownRight',
            'rotateOutUpLeft',
            'rotateOutUpRight',
        ));

    $animations['sliding_entrances'] = array(
        'label' => 'Sliding Entrances', 
        'animations' => array(
            'slideInUp',
            'slideInDown',
            'slideInLeft',
            'slideInRight',
        ));
    $animations['sliding_exits'] = array(
        'label' => 'Sliding Exits', 
        'animations' => array(
            'slideOutUp',
            'slideOutDown',
            'slideOutLeft',
            'slideOutRight',
        ));

    $animations['zoom_entrances'] = array(
        'label' => 'Zoom Entrances', 
        'animations' => array(
            'zoomIn',
            'zoomInDown',
            'zoomInLeft',
            'zoomInRight',
            'zoomInUp',
        ));

    $animations['zoom_exits'] = array(
        'label' => 'Zoom Exits', 
        'animations' => array(
            'zoomOut',
            'zoomOutDown',
            'zoomOutLeft',
            'zoomOutRight',
            'zoomOutUp',
        ));

    $animations['specials'] = array(
        'label' => 'Specials', 
        'animations' => array(
            'hinge',
            'rollIn',
            'rollOut',
        ));
    if ($type)
    {
        return $animations[$type]['animations'];
    }
    else
    {
        return $animations;
    }
}
function snp_is_google_font($font)
{
    $f = snp_get_fonts('google');
    if(in_array($font,$f))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function snp_get_fonts($type = null)
{
    $fonts = array();
    $fonts['system'] = array(
        'label' => 'System Fonts',
        'fonts' => array(
            'Arial',
            'Georgia',
            'Tahoma',
            'Times',
            'Trebuchet',
            'Verdana'
        )
    );
    $fonts['google'] = array(
        'label' => 'Google Fonts',
        'fonts' => array(
            'ABeeZee',
            'Abel',
            'Abril Fatface',
            'Aclonica',
            'Acme',
            'Actor',
            'Adamina',
            'Advent Pro',
            'Aguafina Script',
            'Akronim',
            'Aladin',
            'Aldrich',
            'Alegreya',
            'Alegreya SC',
            'Alex Brush',
            'Alfa Slab One',
            'Alice',
            'Alike',
            'Alike Angular',
            'Allan',
            'Allerta',
            'Allerta Stencil',
            'Allura',
            'Almendra',
            'Almendra Display',
            'Almendra SC',
            'Amarante',
            'Amaranth',
            'Amatic SC',
            'Amethysta',
            'Anaheim',
            'Andada',
            'Andika',
            'Angkor',
            'Annie Use Your Telescope',
            'Anonymous Pro',
            'Antic',
            'Antic Didone',
            'Antic Slab',
            'Anton',
            'Arapey',
            'Arbutus',
            'Arbutus Slab',
            'Architects Daughter',
            'Archivo Black',
            'Archivo Narrow',
            'Arimo',
            'Arizonia',
            'Armata',
            'Artifika',
            'Arvo',
            'Asap',
            'Asset',
            'Astloch',
            'Asul',
            'Atomic Age',
            'Aubrey',
            'Audiowide',
            'Autour One',
            'Average',
            'Average Sans',
            'Averia Gruesa Libre',
            'Averia Libre',
            'Averia Sans Libre',
            'Averia Serif Libre',
            'Bad Script',
            'Balthazar',
            'Bangers',
            'Basic',
            'Battambang',
            'Baumans',
            'Bayon',
            'Belgrano',
            'Belleza',
            'BenchNine',
            'Bentham',
            'Berkshire Swash',
            'Bevan',
            'Bigelow Rules',
            'Bigshot One',
            'Bilbo',
            'Bilbo Swash Caps',
            'Bitter',
            'Black Ops One',
            'Bokor',
            'Bonbon',
            'Boogaloo',
            'Bowlby One',
            'Bowlby One SC',
            'Brawler',
            'Bree Serif',
            'Bubblegum Sans',
            'Bubbler One',
            'Buda',
            'Buenard',
            'Butcherman',
            'Butterfly Kids',
            'Cabin',
            'Cabin Condensed',
            'Cabin Sketch',
            'Caesar Dressing',
            'Cagliostro',
            'Calligraffitti',
            'Cambo',
            'Candal',
            'Cantarell',
            'Cantata One',
            'Cantora One',
            'Capriola',
            'Cardo',
            'Carme',
            'Carrois Gothic',
            'Carrois Gothic SC',
            'Carter One',
            'Caudex',
            'Cedarville Cursive',
            'Ceviche One',
            'Changa One',
            'Chango',
            'Chau Philomene One',
            'Chela One',
            'Chelsea Market',
            'Chenla',
            'Cherry Cream Soda',
            'Cherry Swash',
            'Chewy',
            'Chicle',
            'Chivo',
            'Cinzel',
            'Cinzel Decorative',
            'Clicker Script',
            'Coda',
            'Coda Caption',
            'Codystar',
            'Combo',
            'Comfortaa',
            'Coming Soon',
            'Concert One',
            'Condiment',
            'Content',
            'Contrail One',
            'Convergence',
            'Cookie',
            'Copse',
            'Corben',
            'Courgette',
            'Cousine',
            'Coustard',
            'Covered By Your Grace',
            'Crafty Girls',
            'Creepster',
            'Crete Round',
            'Crimson Text',
            'Croissant One',
            'Crushed',
            'Cuprum',
            'Cutive',
            'Cutive Mono',
            'Damion',
            'Dancing Script',
            'Dangrek',
            'Dawning of a New Day',
            'Days One',
            'Delius',
            'Delius Swash Caps',
            'Delius Unicase',
            'Della Respira',
            'Denk One',
            'Devonshire',
            'Didact Gothic',
            'Diplomata',
            'Diplomata SC',
            'Domine',
            'Donegal One',
            'Doppio One',
            'Dorsa',
            'Dosis',
            'Dr Sugiyama',
            'Droid Sans',
            'Droid Sans Mono',
            'Droid Serif',
            'Duru Sans',
            'Dynalight',
            'Eagle Lake',
            'Eater',
            'EB Garamond',
            'Economica',
            'Electrolize',
            'Elsie',
            'Elsie Swash Caps',
            'Emblema One',
            'Emilys Candy',
            'Engagement',
            'Englebert',
            'Enriqueta',
            'Erica One',
            'Esteban',
            'Euphoria Script',
            'Ewert',
            'Exo',
            'Expletus Sans',
            'Fanwood Text',
            'Fascinate',
            'Fascinate Inline',
            'Faster One',
            'Fasthand',
            'Federant',
            'Federo',
            'Felipa',
            'Fenix',
            'Finger Paint',
            'Fjalla One',
            'Fjord One',
            'Flamenco',
            'Flavors',
            'Fondamento',
            'Fontdiner Swanky',
            'Forum',
            'Francois One',
            'Freckle Face',
            'Fredericka the Great',
            'Fredoka One',
            'Freehand',
            'Fresca',
            'Frijole',
            'Fruktur',
            'Fugaz One',
            'Gabriela',
            'Gafata',
            'Galdeano',
            'Galindo',
            'Gentium Basic',
            'Gentium Book Basic',
            'Geo',
            'Geostar',
            'Geostar Fill',
            'Germania One',
            'GFS Didot',
            'GFS Neohellenic',
            'Gilda Display',
            'Give You Glory',
            'Glass Antiqua',
            'Glegoo',
            'Gloria Hallelujah',
            'Goblin One',
            'Gochi Hand',
            'Gorditas',
            'Goudy Bookletter 1911',
            'Graduate',
            'Grand Hotel',
            'Gravitas One',
            'Great Vibes',
            'Griffy',
            'Gruppo',
            'Gudea',
            'Habibi',
            'Hammersmith One',
            'Hanalei',
            'Hanalei Fill',
            'Handlee',
            'Hanuman',
            'Happy Monkey',
            'Headland One',
            'Henny Penny',
            'Herr Von Muellerhoff',
            'Holtwood One SC',
            'Homemade Apple',
            'Homenaje',
            'Iceberg',
            'Iceland',
            'IM Fell Double Pica',
            'IM Fell Double Pica SC',
            'IM Fell DW Pica',
            'IM Fell DW Pica SC',
            'IM Fell English',
            'IM Fell English SC',
            'IM Fell French Canon',
            'IM Fell French Canon SC',
            'IM Fell Great Primer',
            'IM Fell Great Primer SC',
            'Imprima',
            'Inconsolata',
            'Inder',
            'Indie Flower',
            'Inika',
            'Irish Grover',
            'Istok Web',
            'Italiana',
            'Italianno',
            'Jacques Francois',
            'Jacques Francois Shadow',
            'Jim Nightshade',
            'Jockey One',
            'Jolly Lodger',
            'Josefin Sans',
            'Josefin Slab',
            'Joti One',
            'Judson',
            'Julee',
            'Julius Sans One',
            'Junge',
            'Jura',
            'Just Another Hand',
            'Just Me Again Down Here',
            'Kameron',
            'Karla',
            'Kaushan Script',
            'Kavoon',
            'Keania One',
            'Kelly Slab',
            'Kenia',
            'Khmer',
            'Kite One',
            'Knewave',
            'Kotta One',
            'Koulen',
            'Kranky',
            'Kreon',
            'Kristi',
            'Krona One',
            'La Belle Aurore',
            'Lancelot',
            'Lato',
            'League Script',
            'Leckerli One',
            'Ledger',
            'Lekton',
            'Lemon',
            'Libre Baskerville',
            'Life Savers',
            'Lilita One',
            'Limelight',
            'Linden Hill',
            'Lobster',
            'Lobster Two',
            'Londrina Outline',
            'Londrina Shadow',
            'Londrina Sketch',
            'Londrina Solid',
            'Lora',
            'Love Ya Like A Sister',
            'Loved by the King',
            'Lovers Quarrel',
            'Luckiest Guy',
            'Lusitana',
            'Lustria',
            'Macondo',
            'Macondo Swash Caps',
            'Magra',
            'Maiden Orange',
            'Mako',
            'Marcellus',
            'Marcellus SC',
            'Marck Script',
            'Margarine',
            'Marko One',
            'Marmelad',
            'Marvel',
            'Mate',
            'Mate SC',
            'Maven Pro',
            'McLaren',
            'Meddon',
            'MedievalSharp',
            'Medula One',
            'Megrim',
            'Meie Script',
            'Merienda',
            'Merienda One',
            'Merriweather',
            'Merriweather Sans',
            'Metal',
            'Metal Mania',
            'Metamorphous',
            'Metrophobic',
            'Michroma',
            'Milonga',
            'Miltonian',
            'Miltonian Tattoo',
            'Miniver',
            'Miss Fajardose',
            'Modern Antiqua',
            'Molengo',
            'Molle',
            'Monda',
            'Monofett',
            'Monoton',
            'Monsieur La Doulaise',
            'Montaga',
            'Montez',
            'Montserrat',
            'Montserrat Alternates',
            'Montserrat Subrayada',
            'Moul',
            'Moulpali',
            'Mountains of Christmas',
            'Mouse Memoirs',
            'Mr Bedfort',
            'Mr Dafoe',
            'Mr De Haviland',
            'Mrs Saint Delafield',
            'Mrs Sheppards',
            'Muli',
            'Mystery Quest',
            'Neucha',
            'Neuton',
            'New Rocker',
            'News Cycle',
            'Niconne',
            'Nixie One',
            'Nobile',
            'Nokora',
            'Norican',
            'Nosifer',
            'Nothing You Could Do',
            'Noticia Text',
            'Nova Cut',
            'Nova Flat',
            'Nova Mono',
            'Nova Oval',
            'Nova Round',
            'Nova Script',
            'Nova Slim',
            'Nova Square',
            'Numans',
            'Nunito',
            'Odor Mean Chey',
            'Offside',
            'Old Standard TT',
            'Oldenburg',
            'Oleo Script',
            'Oleo Script Swash Caps',
            'Open Sans',
            'Open Sans Condensed',
            'Oranienbaum',
            'Orbitron',
            'Oregano',
            'Orienta',
            'Original Surfer',
            'Oswald',
            'Over the Rainbow',
            'Overlock',
            'Overlock SC',
            'Ovo',
            'Oxygen',
            'Oxygen Mono',
            'Pacifico',
            'Paprika',
            'Parisienne',
            'Passero One',
            'Passion One',
            'Patrick Hand',
            'Patrick Hand SC',
            'Patua One',
            'Paytone One',
            'Peralta',
            'Permanent Marker',
            'Petit Formal Script',
            'Petrona',
            'Philosopher',
            'Piedra',
            'Pinyon Script',
            'Pirata One',
            'Plaster',
            'Play',
            'Playball',
            'Playfair Display',
            'Playfair Display SC',
            'Podkova',
            'Poiret One',
            'Poller One',
            'Poly',
            'Pompiere',
            'Pontano Sans',
            'Port Lligat Sans',
            'Port Lligat Slab',
            'Prata',
            'Preahvihear',
            'Press Start 2P',
            'Princess Sofia',
            'Prociono',
            'Prosto One',
            'PT Mono',
            'PT Sans',
            'PT Sans Caption',
            'PT Sans Narrow',
            'PT Serif',
            'PT Serif Caption',
            'Puritan',
            'Purple Purse',
            'Quando',
            'Quantico',
            'Quattrocento',
            'Quattrocento Sans',
            'Questrial',
            'Quicksand',
            'Quintessential',
            'Qwigley',
            'Racing Sans One',
            'Radley',
            'Raleway',
            'Raleway Dots',
            'Rambla',
            'Rammetto One',
            'Ranchers',
            'Rancho',
            'Rationale',
            'Redressed',
            'Reenie Beanie',
            'Revalia',
            'Ribeye',
            'Ribeye Marrow',
            'Righteous',
            'Risque',
            'Roboto',
            'Roboto Condensed',
            'Rochester',
            'Rock Salt',
            'Rokkitt',
            'Romanesco',
            'Ropa Sans',
            'Rosario',
            'Rosarivo',
            'Rouge Script',
            'Ruda',
            'Rufina',
            'Ruge Boogie',
            'Ruluko',
            'Rum Raisin',
            'Ruslan Display',
            'Russo One',
            'Ruthie',
            'Rye',
            'Sacramento',
            'Sail',
            'Salsa',
            'Sanchez',
            'Sancreek',
            'Sansita One',
            'Sarina',
            'Satisfy',
            'Scada',
            'Schoolbell',
            'Seaweed Script',
            'Sevillana',
            'Seymour One',
            'Shadows Into Light',
            'Shadows Into Light Two',
            'Shanti',
            'Share',
            'Share Tech',
            'Share Tech Mono',
            'Shojumaru',
            'Short Stack',
            'Siemreap',
            'Sigmar One',
            'Signika',
            'Signika Negative',
            'Simonetta',
            'Sintony',
            'Sirin Stencil',
            'Six Caps',
            'Skranji',
            'Slackey',
            'Smokum',
            'Smythe',
            'Sniglet',
            'Snippet',
            'Snowburst One',
            'Sofadi One',
            'Sofia',
            'Sonsie One',
            'Sorts Mill Goudy',
            'Source Code Pro',
            'Source Sans Pro',
            'Special Elite',
            'Spicy Rice',
            'Spinnaker',
            'Spirax',
            'Squada One',
            'Stalemate',
            'Stalinist One',
            'Stardos Stencil',
            'Stint Ultra Condensed',
            'Stint Ultra Expanded',
            'Stoke',
            'Strait',
            'Sue Ellen Francisco',
            'Sunshiney',
            'Supermercado One',
            'Suwannaphum',
            'Swanky and Moo Moo',
            'Syncopate',
            'Tangerine',
            'Taprom',
            'Tauri',
            'Telex',
            'Tenor Sans',
            'Text Me One',
            'The Girl Next Door',
            'Tienne',
            'Tinos',
            'Titan One',
            'Titillium Web',
            'Trade Winds',
            'Trocchi',
            'Trochut',
            'Trykker',
            'Tulpen One',
            'Ubuntu',
            'Ubuntu Condensed',
            'Ubuntu Mono',
            'Ultra',
            'Uncial Antiqua',
            'Underdog',
            'Unica One',
            'UnifrakturCook',
            'UnifrakturMaguntia',
            'Unkempt',
            'Unlock',
            'Unna',
            'Vampiro One',
            'Varela',
            'Varela Round',
            'Vast Shadow',
            'Vibur',
            'Vidaloka',
            'Viga',
            'Voces',
            'Volkhov',
            'Vollkorn',
            'Voltaire',
            'VT323',
            'Waiting for the Sunrise',
            'Wallpoet',
            'Walter Turncoat',
            'Warnes',
            'Wellfleet',
            'Wendy One',
            'Wire One',
            'Yanone Kaffeesatz',
            'Yellowtail',
            'Yeseva One',
            'Yesteryear',
            'Zeyada')
    );
    if ($type)
    {
        return $fonts[$type]['fonts'];
    }
    else
    {
        return $fonts;
    }
}

function snp_get_font_awesome_list()
{
    return array_unique(array(
'user','envelope','envelope-o','envelope-square','paper-plane','paper-plane-o','phone','phone-square','bed','buysellads','cart-arrow-down','cart-plus','connectdevelop','dashcube','diamond','facebook-official','forumbee','heartbeat','hotel','leanpub','mars','mars-double','mars-stroke','mars-stroke-h','mars-stroke-v',
'medium','mercury','motorcycle','neuter','pinterest-p','sellsy','server','ship','shirtsinbulk','simplybuilt','skyatlas','street-view','subway','train','transgender','transgender-alt','user-plus','user-secret','user-times',
'venus','venus-double','venus-mars','viacoin','whatsapp','adjust','anchor','archive','area-chart','arrows','arrows-h','arrows-v','asterisk','at','automobile','ban','bank','bar-chart','bar-chart-o','barcode','bars','bed',
'beer','bell','bell-o','bell-slash','bell-slash-o','bicycle','binoculars','birthday-cake','bolt','bomb','book','bookmark','bookmark-o','briefcase','bug','building','building-o','bullhorn','bullseye','bus','cab','calculator',
'calendar','calendar-o','camera','camera-retro','car','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','cart-arrow-down','cart-plus','cc','certificate','check','check-circle',
'check-circle-o','check-square','check-square-o','child','circle','circle-o','circle-o-notch','circle-thin','clock-o','close','cloud','cloud-download','cloud-upload','code','code-fork','coffee','cog','cogs','comment',
'comment-o','comments','comments-o','compass','copyright','credit-card','crop','crosshairs','cube','cubes','cutlery','dashboard','database','desktop','diamond','dot-circle-o','download','edit','ellipsis-h','ellipsis-v',
'eraser','exchange','exclamation','exclamation-circle','exclamation-triangle','external-link','external-link-square','eye','eye-slash','eyedropper','fax','female','fighter-jet',
'file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-movie-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o','file-sound-o','file-video-o','file-word-o','file-zip-o','film',
'filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flash','flask','folder','folder-o','folder-open','folder-open-o','frown-o','futbol-o','gamepad','gavel','gear','gears','genderless','gift','glass','globe',
'graduation-cap','group','hdd-o','headphones','heart','heart-o','heartbeat','history','home','hotel','image','inbox','info','info-circle','institution','key','keyboard-o','language','laptop','leaf','legal','lemon-o','level-down',
'level-up','life-bouy','life-buoy','life-ring','life-saver','lightbulb-o','line-chart','location-arrow','lock','magic','magnet','mail-forward','mail-reply','mail-reply-all','male','map-marker','meh-o','microphone',
'microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','mobile-phone','money','moon-o','mortar-board','motorcycle','music','navicon','newspaper-o','paint-brush',
'paw','pencil','pencil-square','pencil-square-o','photo','picture-o','pie-chart','plane','plug','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qrcode','question',
'question-circle','quote-left','quote-right','random','recycle','refresh','remove','reorder','reply','reply-all','retweet','road','rocket','rss','rss-square','search','search-minus','search-plus','send','send-o','server',
'share','share-alt','share-alt-square','share-square','share-square-o','shield','ship','shopping-cart','sign-in','sign-out','signal','sitemap','sliders','smile-o','soccer-ball-o','sort','sort-alpha-asc','sort-alpha-desc',
'sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','space-shuttle','spinner','spoon','square','square-o','star','star-half','star-half-empty','star-half-full',
'star-half-o','star-o','street-view','suitcase','sun-o','support','tablet','tachometer','tag','tags','tasks','taxi','terminal','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle',
'times-circle-o','tint','toggle-down','toggle-left','toggle-off','toggle-on','toggle-right','toggle-up','trash','trash-o','tree','trophy','truck','tty','umbrella','university','unlock','unlock-alt','unsorted','upload',
'user-plus','user-secret','user-times','users','video-camera','volume-down','volume-off','volume-up','warning','wheelchair','wifi','wrench','ambulance','automobile','bicycle','bus','cab','car','fighter-jet','motorcycle','plane',
'rocket','ship','space-shuttle','subway','taxi','train','truck','wheelchair','circle-thin','genderless','mars','mars-double','mars-stroke','mars-stroke-h','mars-stroke-v','mercury','neuter','transgender','transgender-alt','venus',
'venus-double','venus-mars','file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-movie-o','file-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o','file-sound-o','file-text',
'file-text-o','file-video-o','file-word-o','file-zip-o','circle-o-notch','cog','gear','refresh','spinner','check-square','check-square-o','circle','circle-o','dot-circle-o','minus-square','minus-square-o','plus-square',
'plus-square-o','square','square-o','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','credit-card','google-wallet','paypal','area-chart','bar-chart','bar-chart-o','line-chart','pie-chart','bitcoin','btc',
'cny','dollar','eur','euro','gbp','ils','inr','jpy','krw','money','rmb','rouble','rub','ruble','rupee','shekel','sheqel','try','turkish-lira','usd','won','yen','align-center','align-justify','align-left','align-right','bold',
'chain','chain-broken','clipboard','columns','copy','cut','dedent','eraser','file','file-o','file-text','file-text-o','files-o','floppy-o','font','header','indent','italic','link','list','list-alt','list-ol','list-ul','outdent',
'paperclip','paragraph','paste','repeat','rotate-left','rotate-right','save','scissors','strikethrough','subscript','superscript','table','text-height','text-width','th','th-large','th-list','underline','undo','unlink',
'angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left',
'arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','caret-down','caret-left','caret-right',
'caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right',
'chevron-up','hand-o-down','hand-o-left','hand-o-right','hand-o-up','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','toggle-down','toggle-left','toggle-right','toggle-up','arrows-alt','backward','compress',
'eject','expand','fast-backward','fast-forward','forward','pause','play','play-circle','play-circle-o','step-backward','step-forward','stop','youtube-play','adn','android','angellist','apple','behance','behance-square','bitbucket',
'bitbucket-square','bitcoin','btc','buysellads','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','codepen','connectdevelop','css3','dashcube','delicious','deviantart','digg','dribbble','dropbox','drupal',
'empire','facebook','facebook-f','facebook-official','facebook-square','flickr','forumbee','foursquare','ge','git','git-square','github','github-alt','github-square','gittip','google','google-plus','google-plus-square',
'google-wallet','gratipay','hacker-news','html5','instagram','ioxhost','joomla','jsfiddle','lastfm','lastfm-square','leanpub','linkedin','linkedin-square','linux','maxcdn','meanpath','medium','openid','pagelines','paypal',
'pied-piper','pied-piper-alt','pinterest','pinterest-p','pinterest-square','qq','ra','rebel','reddit','reddit-square','renren','sellsy','share-alt','share-alt-square','shirtsinbulk','simplybuilt','skyatlas','skype','slack',
'slideshare','soundcloud','spotify','stack-exchange','stack-overflow','steam','steam-square','stumbleupon','stumbleupon-circle','tencent-weibo','trello','tumblr','tumblr-square','twitch','twitter','twitter-square','viacoin',
'vimeo-square','vine','vk','wechat','weibo','weixin','whatsapp','windows','wordpress','xing','xing-square','yahoo','yelp','youtube','youtube-play','youtube-square'
    ));
}