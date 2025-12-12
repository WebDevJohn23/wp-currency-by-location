# WP Currency by Location

Detect user location via IP and apply automatic currency and pricing adjustments. Successor to "Country Code via IP Address - V2".
---

## Project Status

This repository represents a point-in-time build created for demonstration, experimentation, or portfolio review.

- Development state may vary over time
- Some dependencies or external integrations may require updates to run locally
- Code is provided for review of structure, patterns, and problem-solving approach
- Not intended as a drop-in production deliverable

This project is best evaluated by reviewing the codebase and commit history rather than expecting long-term maintenance or turnkey execution.

---

## Features
- IP-based country detection
- Currency conversion helper
- Shortcodes for quick integration: `[wpcl_country]`, `[wpcl_convert amount="100" from="USD" to="EUR"]`
- Admin settings for API keys and default currency

---

## Installation
1. Upload the `wp-currency-by-location` folder to `/wp-content/plugins/`
2. Activate the plugin in WordPress
3. Go to Settings → Currency by Location and configure

---

## Version History
- 3.0.0 – Renamed to WP Currency by Location. Added pricing helpers and settings.
- 2.0.0 – Country Code via IP Address – V2
- 1.0.0 – Initial release

## License
GPL-2.0-or-later
