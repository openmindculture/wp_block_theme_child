# WordPress Block Theme Child Template

[wp_block_theme_child](https://github.com/openmindculture/wp_block_theme_child) is a local host WordPress setup using Docker, docker-compose, and wp-cli to install themes and plugins, including a simple template skeleton for a Twenty Twenty-Three child theme using the template engine (`theme.json`), block editor and full-site editing.

## Usage

### Initial Setup

Edit localhost ports and initial plugins in `install-local-environment.js` and `docker-compose.yml`, then run `npm install` and open http://localhost:8023/wp-admin (replace `8023` with the configured port) in your browser. Log in with the default demo credentials (user: `admin`, password: `secret`).

The following directories are mounted below the project root directory by default:

- plugins
- themes
  - themes/twentytwentythree-child
- wp_data

They are set to be ignored in `.gitignore`, except for `themes/twentytwentythree-child`.

Check an edit your IDE settings to exclude or exclude these directories for search / indexing. Edit write permissions if necessary before editing the child theme, e.g.

```
sudo chown -R your_username:your_group themes
sudo chmod -R ug+rw themes
```

### Start, Stop, Destroy

- `npm start` (re)starts the local WordPress server
- `npm stop` will retain local data after stopping
- `npm run destroy` stops and removes local data

## Further Reading, Alternatives, and Known Issues

This respository is based on a fork of [wp_cli_docker](https://github.com/openmindculture/wp_cli_docker) and follows the opposite direction of the classic / hybrid [wp_template_opinionated](https://github.com/openmindculture/wp_template_opinionated) theme template.

The installation script has been conceived to work anywhere, but it has actually been tested and used mostly on Ubuntu Linux. There have been configuration and performance issues especially on slow Windows WSL Docker systems.

## Requirements

- npm
- Docker
- docker-compose

## Configuration

### Configure pre-installed Themes and Plugins

Modify [install-local-environment.js](./install-local-environment.js) to select which themes and plugins will be installed automatically using `wp-cli`. You must specify the technical names (text domains), not the current titles! The technical names are the same as the directory names in the plugin paths.

```js
/* specify the technical names (text domain) of plugins to be installed */
'wp plugin install incompatibility-status updraftplus --activate';
```

Some commercial / paid plugins cannot be installed automatically. They have to be uploaded or installed manually later.

### Configure WordPress Core, Web Server, PHP Version used

Modify [docker/WordPress.Dockerfile](./docker/WordPress.Dockerfile) to choose one of various predefined configurations using different PHP versions like 7.4, 8.0, 8.1 etc. and popular web servers like Apache or nginx to copy our customer's web hosting provider's technical setup as good as possible.

See https://hub.docker.com/_/wordpress/ for available docker tags, or keep `wordpress:latest` for the newest (latest) stable release.

```Dockerfile
FROM wordpress:latest
# use other tags in docker/wordpress.Dockerfile to test specific versions, see
# https://hub.docker.com/_/wordpress/
# FROM wordpress:6.1.1-php8.0-apache
```
