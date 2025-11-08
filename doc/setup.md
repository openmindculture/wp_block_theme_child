# Setup Details

## WordPress Block Theme Child Template

[wp_block_theme_child](https://github.com/openmindculture/wp_block_theme_child) is a local host WordPress setup using Docker, docker-compose, and wp-cli
to install themes and plugins, including a simple template skeleton for a Twenty-something child
theme using the template engine (`theme.json`), block editor and full-site editing.

## Protect WordPress Stage Setups

To ensure your WordPress staging site is not indexed, enable "Discourage search engines from indexing this site" in 
WordPress Settings > Reading, or use an SEO plugin like Yoast SEO to set site-wide `noindex` directives.
For added security, you can also password-protect your staging environment or add a robots.txt file with `Disallow: /`

## TODO / Work in Progress

This is an unfinished stub, based on `wp_cli_docker` (see below). Ideas and learning takeaways from other (open source) projects should be ported back to and collected in this repository.

### Synchronizing with Upstream Source Code

You probably don't want to synchronize incoming changes too often to prevent resolving unnecessary "conflicts" in git due to minor changes in the upstream source code. To merge incoming upstream changes into your project code, type

```
git fetch upstream
git merge origin/main --allow-unrelated-histories
```

If you want to synchronize fixes and improvements back up, feel free to open a pull request / merge request / issue in the upstream repository.

## White Label / Template Customization

### zip and ship

There is **no build step**, unless you need custom blocks, you can zip and ship the theme folder as it is. This also means that you cannot use SCSS, TypeScript, or any other experimental synatx that is not widely supported by major browsers (see MDN or caniuse if in doubt).

### fork or add Upstream

To use this repository as a template for a new WordPress theme, fork it on GitHub or set it as a remote upstream of an existing project. Modify the `twentytwentyfive-child` theme according to your (customers') requirements.

- `git remote add upstream git@github.com:openmindculture/wp_block_theme_child.git`

Use `git remote -v` to verify (or list) the configured remote repositories.

To synchronize/pull upstream updates, we can use it similar to working with branches:

- `git fetch upstream`
- `git merge upstream/main --allow-unrelated-histories`

The `-allow-unrelated-histories` is only necessary the first time, then both are considered to be related.

When a merge causes a conflict, you can

- `git checkout --ours path/to/file` to keep the local file and discard the incoming remote, or
- `git checkout --theirs path/to/file` to accept the incoming to overwrite an existing local file,
- or edit (text files) manually,

then:

- `git add .`
- `git merge --continue`

and avoid unnecessarily editing existing files in the upstream template repository!

### WP child theme with custom title

You can change the display name and screenshot to make the theme appear as an individual customer theme, while the technical name (textdomain) stays twentytwentyfive-child making it a child theme of the official WordPress theme Twenty Twenty-Five.

#### customize navigation

This child theme template has a classic navigation menu in the `header.php` using `wp_list_pages` which can be customized and filtered accordingly. To exclude pages linked in the footer, like imprint and privacy, from the header navigation menu, you can add known page id values to the `exclude` parameter or add another custom include/exclude logic.

### multiple inheritance, sort of

Effectively, you will have two upstreams providing you with updates: twentytwentyfive (at run time via WordPress updates) and this template respository, `wp_block_theme_child`, only when you chose to check and pull updates into your forked/downstream version.

### example content

The example-content directory contains code that you can paste in code mode to fill three example pages, plus four blog posts three of which will be featured on the home page.

Example content might mix German and English examples, as well as classic Lorem Ipsum placeholder text, and some Japanese, Ukrainian and Arabic sample text to ensure multiple character sets and writing directions are supported correctly.

"Blog" is often called "news", but we can stick to the built-on blog `post` post type. Even when we think we need different post types, this might get done using categories.

Product examples are inspired by actual second hand items that I used to offer at [This shop](https://example.com/), willhaben, and Kleinanzeigen, as well as public open source content from Wikipedia, the free encyclopedia.

### optional plugin options

Recommendations based on small customer projects in recent years:

- Akismet
- Complianz
- Contact Form 7
- [Display Featured Image in Post List](https://de.wordpress.org/plugins/display-featured-image-in-post-list/)
- [Incompatibility Status](https://github.com/openmindculture/wp-incompatibility-status/)
- Polylang
- [Post Types Order](https://de.wordpress.org/plugins/post-types-order/)
- UpdraftPlus
- WooCommerce
- Yoast (WP-SEO)

and any image optimization and/or caching plugin, unless your (managed) host already provides that functionality:

- [TinyPNG](https://de.wordpress.org/plugins/tiny-compress-images/)
- W3 Total Cache (not on stage/preview)

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

#### theme.json customization

Copy the existing theme.json to your downstream child theme repository, delete what you don't need and add or modify remaining values as you need.

See the detailed instructions and information about fonts, colors etc. in the section below.

Using theme.json comes with certain problems, much like using Tailwind v3, but without good IDE support: arbitrary custom property variable names that are unknown to the IDE when used in `style.css` or imported components. Pragmatically, we might just write classic CSS and adjust the theme.json values so that content editors use the same colors and fonts, and to let WordPress create the necessary font definitions and make the theme load the expected files.

#### Opinionated Minimalism and Redundancy

We don't need to define `style`, `core/` blocks, and `elements` in our `theme.json`, but the parent theme does, and we can't totally unset them without overriding each. A more minimal, classic, and lintable CSS approach:
 - use only minimal `theme.json` definitions:
   - color palette
   - font family face files and setup
 - unload (dequeue) parent theme styles using PHP
 - write classic CSS
   - using overly specific selectors like `h2, body h2` to ensure overriding parent styles
   - defining custom font size variables
   - and possibly repeat some theme.json values
     - either in style.css
     - or in a preview css only used in the IDE

Why still use a child theme at all?

- parent markup and templates
- core functionality
- core blocks

so we will still write less code and be quicker for simple websites.

When not to use a child theme? A highly customized site should still use its own custom theme.

#### redundant preview values

An optional `_variables_preview.css` file only serves the purpose to expose theme.json colors and settings redundantly for better preview, autocompletion and to prevent unresolved var() errors at development time, while it is not loaded and used in the frontend.

This preview style file can have any arbitrary name or location parallel to or above the theme's stylecss to be recognized by most coding editors.

#### explicit font family utility classes

Font family utility classes might only be generated on demand, so as a workaround, we can define them manually if necessary, e.g.

```css
  .has-font-family-nunito {
      font-family: var(--wp--preset--font-family--nunito);
  }
```

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

Manrope is a free variable sans font using font variation axis, thus there is one web font file, but we need to specify additional `fontVariationSettings` in our `theme.json` `fontFamilies` `fontFace` definitions. The included example uses a western/latin + cyrillic character set, probably missing arabic and eastern asian glyphs, with certain predefined font weights and slants so that it acts like when using different distinct fixed font files. **TODO**: check if and how WordPress 6.8+ supports variable fonts more flexible for fluid typography and seamless settings!

Atkinson Hyperlegible might look a little too technical for marketing puropose, however it was designed for maximum legibility in the sense of accessibility and glyph disambiguation.

The example theme uses a combination of Markazi and Nunito, the latter only used for second-level sub-headlines for the sake of demonstrating how to provide different default web fonts in a theme.

#### color palette

![color palette example](doc/color-palette-example.png)

The initial example color palette contains more colors that you'd usually need. *Customization TODO*: modify and reduce so that you have:
- corporate identity design system colors
- a dark red color for error messages
- a dark green color for success messages
- 100% black unless you have a similar dark design color
- 100% white unless you have a similar light design color

and ideally prevent website content editors to choose color combinations that violate accessible color contrast or cause red–green color vision deficiency issues. Consequentially, avoid including reddish and greenish tones with the same hue and make sure to run  accessibility audits while designing and testing your website.

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

Please add the missing fontFamilies fontFace definitions for a WordPress theme JSON in the following format matching the list of font file names below

