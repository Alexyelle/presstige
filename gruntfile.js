module.exports = function(grunt){

	require('time-grunt')(grunt);
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),    
        /*
		//	Détection des modifications :
		//	-	scss/php/html du projet avec refresh auto dans navigateur
		//	-	images pour minifications auto lors d'ajout d'images dans le dossier img
		//	-	js pour minification automatique (seulement pour les fichiers listé dans la tâche scripts)
		//	-	dans le dossier des icones pour re-générer le sprite svg
        */    
 		watch: {
 			css: {
 				files: 'sass/*.scss',
 				tasks: ['sass', 'notify:sasswatch', 'postcss', 'notify:csswatch'],	
 		        options: {
 		            spawn: false
 		        }
 			},
 			php: {
 				files: ['*.php']
 			},
 			html: {
                files: ['*.html']
            },
 			icons: {
                files: ['img/icons/src/*.svg'],
 				tasks: ['grunticon', 'notify:iconswatch'],	
            },
 			images: {
 				files: ['img/src/*.{png,jpg,gif}', 'img/*.{png,jpg,gif}'],
 				tasks: ['imagemin'],
 				options: {
 				  spawn: false,
 				}
 			},
			scripts: {
		        files: ['js/*.js'],
		        tasks: ['uglify'],
		        options: {
		            spawn: false,
		        },
		    }, 
 		},
 		/*
		// Tâche permettant la génération d'un sprite svg avec fallback.
		// Création de selecteur css spécifique via l'option "customselectors"
		// Ajouter un nouvel svg dans le dossier img/icons/src et lancer la tâche grunt grunticon.
 		*/
        grunticon:{
         	myIcons:{
         		files: [{
 					expand: true,
 					cwd: 'img/icons/src',
 					src: ['*.svg'],
 					dest: "img/icons"
 				}],
 				options: {					
 					loadersnippet: "grunticon.loader.js",
 					enhanceSVG: true,					
 					customselectors: {
 						"home-red" : [".main-navigation li:hover.icon-home"] // Exemple
 					} 
 				},
         	}
        },
        /*
		// Compilation de tous les fichiers scss se trouvant dans le dossier sass
        */
 		sass: {
 	      	dist: {
		        files: [{ 
					"expand": true,
					"cwd": "sass/",
					"src": ["*.scss"],
					"dest": "css/",
					"ext": ".css"
	 	        }]
 	      	}
 	    },
 	    /*
		// Notification (non obligatoire mais utilisable avec snarl si désiré)
 	    */		
 		notify: {
 		  sasswatch: {
 		    options: {
 		      title: 'Task Complete',  // optional
 		      message: 'SASS finished running', //required
 		    }
 		  },
 		  csswatch: {
 		    options: {
 		      title: 'Task Complete',
 		      message: 'CSS finished running',
 		    }
 		  },
 		  iconswatch: {
 		    options: {
 		      title: 'Task Complete',
 		      message: 'Grunticon finished running',
 		    }
 		  }
 		},
 		/*
		//	Tâche qui passe après la compilation sass pour :
		//	-	génération des sourcempas
		//	-	ajouts des fallbacks aux unités rem
		// 	-	préfixe automatiquement ajouté si nécessaire en fonction du nombre de versions à supporter
		//	-	minification css
 		*/
 		postcss: {
 		    options: {
 		      map: true,
 		      processors: [
 		        require('pixrem')(), // add fallbacks for rem units
 		        require('autoprefixer')({browsers: 'last 3 versions'}), // add vendor prefixes
 		        require('cssnano')() // minify the result
 		      ]
 		    },
 		    dist: {
 		      files: [{ 
 		        "expand": true,
 		        "cwd": "css/",
 		        "src": ["*.css"],
 		        "dest": "css/",
 		        "ext": ".css"
 		      }]
 		     }
 		},
 		/*
		//	Minification des fichiers js listé
 		*/
 		uglify: {
 			options: {
 				compress: {
 					drop_console: true,
 					global_defs: {
 			          	"DEBUG": false
 			        },
 					dead_code: true
 				}
 			},
 		    general: {
 				files: {
 					'js/general.min.js': ['js/general.js'],
 					'js/navigation.min.js': ['js/navigation.js']
 				}
 		    }
 		},
 		/*
		//	Minification des images png/jpg/gif
 		*/
 		imagemin : {
 		    dynamic: {
 		       files: [{
 		         expand: true,
 		         cwd: 'img/',
 		         src: ['**/*.{png,jpg,gif}'],
 		         dest: 'img/'
 		       }]
 		     }
 		},
 		/*
		//	Live reload et injection css (sans rafraîchissement de page)
 		*/
 		browserSync: {
 		    dev: {
 		        bsFiles: {
 		            src : [
 		                'css/*.css',
 		                '*.php'
 		            ]
 		        },
 		        options: {
 		            watchTask: true, // Sépcifie qu'on utilise un watch perso et non celui de browsersync
 		            proxy: 'wordpresstest.local' // Adapter selon projet et config local
 		        }
 		    }
 		}
     });

	// Chargement des plugins
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-grunticon');
	grunt.loadNpmTasks('grunt-notify');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browser-sync');

	// Enregistrement des tâches 
	grunt.registerTask('default', ['browserSync', 'watch']); // "default" = "grunt" en ligne de commande directement dans le dossier du thème
	grunt.registerTask('compil', ['sass', 'postcss']); // Pour lancer cette tâche il faut écire "grunt compil". Tâche pour lancer une compil rapide sans watch

};