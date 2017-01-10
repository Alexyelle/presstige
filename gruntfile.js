module.exports = function(grunt){

	require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		sass: {
	      dist: {
	        options: {
	          style: 'expanded',	          
	          sourceMap: true,
	        },
	        files: [{ 
	          "expand": true,
	          "cwd": "sass/",
	          "src": ["*.scss"],
	          "dest": "css/",
	          "ext": ".css"
	        }]
	      }
	    },		
		notify: {
		  watch: {
		    options: {
		      title: 'Task Complete',  // optional
		      message: 'SASS finished running', //required
		    }
		  }
		},
		postcss: {
		    options: {
		      map: true,
		      
		      /*map: {
		          inline: false, // save all sourcemaps as separate files...
		          annotation: 'css/' // ...to the specified directory
		      },*/

		      processors: [
		        require('pixrem')(), // add fallbacks for rem units
		        require('autoprefixer')({browsers: 'last 3 versions'}), // add vendor prefixes
		        require('cssnano')() // minify the result
		      ]
		    },
		    dist: {
		      src: 'css/*.css'
		    }
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['sass', 'postcss', 'notify:watch'],	
		        options: {
		            spawn: false,
		            livereload: true,
		        },	
			},
			php: {
				files: ['**/*.php'],
				options: { livereload: true, }
			},
			html: {
				files: ['**/*.html'],
				options: { livereload: true, }
			},
			scripts: {
		        files: ['js/*.js'],
		        tasks: ['uglify'],
		        options: {
		            spawn: false,
		        },
		    }, 
			images: {
				files: ['img/**/*.{png,jpg,gif}', 'img/*.{png,jpg,gif}'],
				tasks: ['imagemin'],
				options: {
				  spawn: false,
				}
			}
		},
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
					'js/general.min.js': ['js/general.js']
				}
		    }
		},
		imagemin : {
		    dynamic: {
		       files: [{
		         expand: true,
		         cwd: 'img/',
		         src: ['**/*.{png,jpg,gif}'],
		         dest: 'img/'
		       }]
		     }
		}
    });

    grunt.registerTask('default', ['watch']);
};