# wp_block_theme_child

WordPress block theme child is a WordPress child theme template for a classic/hybrid theme using the Gutenberg block editor but no full site editing, so that we can control our HTML head, page header, and page footer markup in PHP without the need for custom blocks or block variations, and no need to conform to the Gutenberg markup syntax.

## The Theme's Technological Basis

The current template defines a Twenty Twenty-Five child theme, based on the official WordPress twentytwentyfive default theme. We might want to change this to a Twenty Twenty-Six child theme in 2026 or 2027. A previous template version was based on Twenty Twenty-Three, following a similar concept.

### Theme Styles in CSS and theme.json

We use both `styles.css` and `theme.json` to define typography and a global color palette redundantly, so that content editors will only see the expected style options in the block editor.

### How to (re-)enable Full Site Editing (FSE)

You can delete the line `add_theme_support('block-templates', false);` in `inc/functions/customize-frontend.php` (required by `functions.php`) to reenable full site editing and use `parts/` and `patterns/` files instead of the classic `/header.php` and `footer.php` includes.

### License and Disclaimer

This code is free and open-source software without any warranty whatsoever. This template is subject to change or deletion at any time. You can fork, copy, use and modify its code at your own risk.

## WordPress Block Theme Child Template

[wp_block_theme_child](https://github.com/openmindculture/wp_block_theme_child) is a local host WordPress setup using Docker, docker-compose, and wp-cli
to install themes and plugins, including a simple template skeleton for a Twenty-something child
theme using the template engine (`theme.json`), block editor and full-site editing.

### Initial Setup

- `npm install`
- `npm start` (or `docker compose up --build`)
- `npm run open` and navigate to `/wp-admin` 
- or open http://localhost:8026/wp-admin (replace `8026` with the configured port) in your browser.
- Log in with the default demo credentials (user: `admin`, password: `secret`).

### Deployment

- zip and ship theme folder

see [doc/setup.md](doc/setup.md)
