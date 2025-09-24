# WordPress Block Theme Child Template

[wp_block_theme_child](https://github.com/openmindculture/wp_block_theme_child) is a local host WordPress setup using Docker, docker-compose, and wp-cli
to install themes and plugins, including a simple template skeleton for a Twenty-something child
theme using the template engine (`theme.json`), block editor and full-site editing.

## TODO / Work in Progress

This is an unfinished stub, based on `wp_cli_docker` (see below). Ideas and learning takeaways from other (open source) projects should be ported back to and collected in this repository.

## White Label / Template Customization

### zip and ship

There is **no build step**, unless you need custom blocks, you can zip and ship the theme folder as it is. This also means that you cannot use SCSS, TypeScript, or any other experimental synatx that is not widely supported by major browsers (see MDN or caniuse if in doubt).

### fork or add Upstream

To use this repository as a template for a new WordPress theme, fork it on GitHub or set it as a remote upstream of an existing project. Modify the `twentytwentyfive-child` theme according to your (customers') requirements.

### WP child theme with custom title

You can change the display name and screenshot to make the theme appear as an individual customer theme, while the technical name (textdomain) stays twentytwentyfive-child making it a child theme of the official WordPress theme Twenty Twenty-Five.

### multiple inheritance, sort of

Effectively, you will have two upstreams providing you with updates: twentytwentyfive (at run time via WordPress updates) and this template respository, `wp_block_theme_child`, only when you chose to check and pull updates into your forked/downstream version.

### example content

The example-content directory contains code that you can paste in code mode to fill three example pages, plus four blog posts three of which will be featured on the home page.

Example content might mix German and English examples, as well as classic Lorem Ipsum placeholder text, and some Japanese, Ukrainian and Arabic sample text to ensure multiple character sets and writing directions are supported correctly.

"Blog" is often called "news", but we can stick to the built-on blog `post` post type. Even when we think we need different post types, this might get done using categories.

Product examples are inspired by actual second hand items that I used to offer at [Prelovedshop](https://www.prelovedshop.de/) , Kijiji, and Kleinanzeigen, as well as public open source content from Wikipedia, the free encyclopedia.

### optional plugin options

Recommendations based on small customer projects in recent years:

- Contact Form 7
- Display Featured Image in Post List
- Incompatibility Status
- Polylang
- Post Types Order
- UpdraftPlus
- WooCommerce
- Yoast (WP-SEO)

and any image optimization and/or caching plugin, unless your (managed) host already provides that functionality.

Polylang is a proven plugin for multi-language localization, especially for small sites that might be fine using the free version.

Contact Form 7, Updraft Plus, and W3 Total Cache are proven plugins that used to work well for small sites even without a paid pro license.

WooCommerce is fine for a small shop that doesn't need much customization, otherwise you might want to consider alternatives that allow for more customization and performance optimization. Likewise, you should check out alternatives to other plugins suggested above.

### minimalism and best practices

Adhere to WordPress best practices, apply minimal changes and prefer content and configuration over modification to avoid conflicting side effects of any future update!

## Repository Usage

### Initial Setup

Run 
- `npm install` 
- `docker compose up --build`
- open http://localhost:8026/wp-admin (replace `8026` with the configured port) in your browser.
- Log in with the default demo credentials (user: `admin`, password: `secret`).

The following directories are mounted below the project root directory by default:

- plugins
- themes
  - themes/twentytwentyfive-child
- wp_data

They are set to be ignored in `.gitignore`, except for the child themes.

Check an edit your IDE settings to exclude or exclude these directories for search / indexing. Edit write permissions
if necessary before editing the child theme, e.g.

```
sudo chown -R your_username:your_group themes
sudo chmod -R ug+rw themes
```

Likewise, we might have to explicitly allow uploads by clients:

`sudo chmod -R ugo+rwx wp_data/uploads`

Most warnings can be safely ignored, especially warnings about deprecations and vulnerabilities at development time, as we only ship minimal custom code, no keys or production passwords, and shouldn't normally be affected by any memory leaks due to the limited number of files and directory depth.

#### Redirect Issue

If you keep getting redirected to a wrong localhost port,
- ensure that all ports are configured correctly in `docker-compose.yml`

and try

- shutting down the setup: `docker compose down -v`
- optionally clean up any other docker related data
- alternatively, try another browser as it might be a caching issue
- try adding `/wp-admin` to prevent the frontend redirect

#### WordPress Updates

If there is a more recent WordPress version that in the `wordpress:latest` Docker image, you should be able to update the local system in your `wp-admin` dashboard.

### Start, Stop, Destroy

- `npm start` (re)starts the local WordPress server
- `npm stop` will retain local data after stopping
- `npm run destroy` stops and removes local data

## Customization

- functions.php
- screenshot.png
- style.css
- theme.json

optionally:
- custom assets (fonts, images)
- custom scripts
- custom blocks, block variations, or template parts

## Further Reading, Alternatives, and Known Issues

### References

#### theme.json Reference (WordPress.org)

https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/

#### theme.json Font Definition

https://fullsiteediting.com/lessons/theme-json-typography-options/#using-the-web-fonts-api-with-theme-json

TODO: check for updated possibilities and best practices like WP font API

Font choice: many commercial fonts have slightly similar alternatives that might be good enough for a startup with limited budget, like using Nunito instead of Avenir or Futura. Note that there are at least two different Nunito designs, so don't use the rounded one when looking for the classic (retro-)futuristic style.

Popular pairings include Lora, Alegreya, Roboto and Open Sans. Noto is known as a minimalist sans-serif font that supports as many international languages as possible.

Markazi Text is a free font found on Google Fonts useful for an elegant but readable Arabic business site. Roman letters have serifs and a similar overall appearance. Use the Aleppo Soap example product for a preview.

Atkinson Hyperlegible might look a little too technical for marketing puropose, however it was designed for maximum legibility in the sense of accessibility and glyph disambiguation.

The example theme uses a combination of Markazi and Nunito, the latter only used for second-level sub-headlines for the sake of demonstrating how to provide different default web fonts in a theme. 

#### full site editing child themes

https://fullsiteediting.com/lessons/child-themes/

### Origin and Alternatives

This respository was based on a fork of [wp_cli_docker](https://github.com/openmindculture/wp_cli_docker) and follows the opposite direction of the classic / hybrid
[wp_template_opinionated](https://github.com/openmindculture/wp_template_opinionated) theme template.

### Issues

The child template is an incomplete stub including references to non-existing assset files in
`themes/twentytwentythree-child/theme.json`. The theme needs to be edited and verified!

The installation script has been conceived to work anywhere, but it has actually been tested and used mostly on Ubuntu Linux. There have been configuration and performance issues especially on slow Windows WSL Docker systems.

![screenshot](doc/screenshot-themes.png)

## Requirements

- npm
- Docker (incl. Docker compose)

## Development Setup Configuration

### Configure pre-installed Themes and Plugins

Modify [install-local-environment.js](./install-local-environment.js) to select which themes and plugins will be installed automatically using `wp-cli`.
You must specify the technical names (text domains), not the current titles! The technical names are the same as the
directory names in the plugin paths.

```js
/* specify the technical names (text domain) of plugins to be installed */
'wp plugin install --activate incompatibility-status';
```

Some commercial / paid plugins cannot be installed automatically. They have to be uploaded or installed manually later.

### Configure WordPress Core, Web Server, PHP Version used

Modify [docker/WordPress.Dockerfile](./docker/WordPress.Dockerfile) to choose one of various predefined configurations using different PHP versions
like 7.4, 8.0, 8.1 etc. and popular web servers like Apache or nginx to copy our customer's web hosting provider's
technical setup as good as possible.

See https://hub.docker.com/_/wordpress/ for available docker tags, or keep `wordpress:latest` for the newest (latest) stable release.

```Dockerfile
FROM wordpress:latest
# use other tags in docker/wordpress.Dockerfile to test specific versions, see
# https://hub.docker.com/_/wordpress/
# FROM wordpress:6.1.1-php8.0-apache
```

### Technical Notes

The `copyfiles` module causes a warning about its `inflight` dependency which is officially deprecated due to an alleged memory leak. However, for a small project like this with less than a hundred files in total in a handful of directories nested no deeper than three levels, the severity is likely minimal or negligible.

## Preview (seriously, you should replace that image)

![screenshot](themes/twentytwentyfive-child/screenshot.png)

TODO: replace that ugly placeholder image with a beautiful screenshot of your actual theme!