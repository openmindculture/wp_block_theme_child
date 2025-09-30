# wp_block_theme_child

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
