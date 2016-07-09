# [ShowTV.com WP Bedrock Application](https://showtv.com/)

*Powered by Roots.io's [Bedrock Wordpress framework](web/app/themes/showtv) and [Sage theme starter kit](https://github.com/roots/sage)*.

ShowTV.com keeps track of the latest TV shows.

## Requirements

* PHP >= 5.5
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* Global installation of the following node modules
 ** [gulp](http://gulpjs.com/)
 ** [bower](https://bower.io/)

## Installation of the Bedrock application

1. Clone the git repo - `git clone https://github.com/jpcaparas/com-showtv.git`
2. Run `composer install`
3. Copy `.env.example` to `.env` and update environment variables:
  * `DB_NAME` - Database name
  * `DB_USER` - Database user
  * `DB_PASSWORD` - Database password
  * `DB_HOST` - Database host
  * `WP_ENV` - Set to environment (`development`, `staging`, `production`)
  * `WP_HOME` - Full URL to WordPress home (http://showtv.com)
  * `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
  * `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT` - Generate with [wp-cli-dotenv-command](https://github.com/aaemnnosttv/wp-cli-dotenv-command) or from the [Roots WordPress Salt Generator](https://roots.io/salts.html)
4. Add theme(s) in `web/app/themes` as you would for a normal WordPress site.
5. Set the document root to the `web` directory.
6. Access WP admin at `http://showtv.com/wp/wp-admin`
7. Activate the bundled `ShowTV` theme.
8. Activate important plugins (e.g. Meta Slider, Yoast)
9. Set *The Movie Database (TMDB)* and *YouTube* options on the dashboard.

![TMDB and YouTube options](http://i.imgur.com/QTKrYas.png)

## Documentation

Bedrock documentation is available at [https://roots.io/bedrock/docs/](https://roots.io/bedrock/docs/).
