let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |


mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

*/

mix.styles([
    'resources/assets/css/style.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleCardHome.css',
    'resources/assets/css/styleArrows.css',
  ],
  'public/css/home.css');

mix.styles([
    'resources/assets/css/search.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleCard.css',
    'resources/assets/css/styleArrows.css',
  ],
  'public/css/homeSearch.css');

mix.styles([
    'resources/assets/css/search.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleArrows.css',
    'resources/assets/css/styleSettings.css',
  ],
  'public/css/homeSettings.css');

  mix.styles([
    'resources/assets/css/build.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleCard.css',
    'resources/assets/css/styleArrows.css',
  ],
  'public/css/homeBuild.css');

  mix.styles([
    'resources/assets/css/steps.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleCardBuild.css',
    'resources/assets/css/styleArrows.css',
    'resources/assets/css/lastresort.css',
  ],
  'public/css/homeSteps.css');

  mix.styles([
    'resources/assets/css/search.css',
    'resources/assets/css/styleForm.css',
    'resources/assets/css/styleArrows.css',
    'resources/assets/css/styleProfile.css',
  ],
  'public/css/homeProfile.css');