# First, require any additional compass plugins installed on your system.
# require 'breakpoint'


# Toggle this between :development and :production when deploying the CSS to the
# live server. Development mode will retain comments and spacing from the
# original Sass source and adds line numbering comments for easier debugging.
environment = :development

# Enable sourcempas on everything but production.
sourcemap = (environment == :production) ? false : true

# In development, we can turn on the FireSass-compatible debug_info.
# firesass = false
firesass = true


# Location of the your project's resources.
css_dir = "css"
sass_dir = "sass"
images_dir = "img"
javascripts_dir = "js"
fonts_dir = "css/fonts"


# Set this to the root of your project. All resource locations above are
# considered to be relative to this path.
http_path = "../"

# To use relative paths to assets in your compiled CSS files, set this to true.
#relative_assets = true

##
## You probably don't need to edit anything below this.
##

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false

# if environment == :production
#   output_style = :compressed
# else
#   output_style = :development
#   sass_options = { :debug_info => true }
# end

output_style = :compressed

# Désactiver l'ajout du cache buster sur les images appelées via la fonction image-url().
asset_cache_buster :none