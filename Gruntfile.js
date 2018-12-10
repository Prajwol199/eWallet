module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      js: {
	      options: {
	        beautify: true
	      },
	      files: {
	        'build/app.min.js': ['build/app.js']
	      }
	    },
    },

    concat: {
    	options:{
    		separator:"\n"
    	},
    	js: {
    		src: [
    			'./src/js/wrapper/start.js',
    			'./src/utility/*.js',
                './src/modules/**/*.js',
    			'./src/js/wrapper/end.js'
    		],
    		dest: './build/app.js'
    	},
    	template: {
    		src: [
    			'./src/modules/**/*.tpl.php'
    		],
    		dest: './build/templates.php'
    	}
	},

	watch: {
	  scripts: {
	    files: ['src/***/**/*.js', 'src/***/**/*.tpl.php'],
	    tasks: ['default'],
	    options: {
	      spawn: false,
	    },
	  },
	},
  });

  // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
    // Default task(s).
    grunt.registerTask('default', [ 'concat', 'uglify' ]);

};