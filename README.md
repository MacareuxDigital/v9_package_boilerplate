# Concrete CMS Package: V9 Package Boilerplate

A boilerplate to develop a package on Concrete CMS Version 9.

## Contains

* Theme
* Custom Block Type
* Doctrine Entity
  * Single Page to search, add, edit, delete entities
  * Block Type to show entities
* External API
  * Block Type to show resources from an external REST API.
* External File Provider
  * A mock configuration file to show how to implement a configuration class to add a new external file provider.

## Directories

| Directories                                  | Description                                                                                                                                                           |
|----------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `blocks/boilerplate_poke_api`                | A block type to show resources from an external REST API.                                                                                                             |
| `blocks/boilerplate_product_list`            | A block type to show Doctrine Entries.                                                                                                                                |
| `blocks/boilerplate_sample_block`            | A sample block type of basic custom content.                                                                                                                          |
| `controllers/element/products`               | Controllers for elements for single pages to manage Doctrine Entries.                                                                                                 |
| `controllers/single_page/dashboard/products` | Controllers for single pages to manage Doctrine Entries.                                                                                                              |
| `elements/external_file_provider_types`      | Elements for External File Providers.                                                                                                                                 |
| `elements/products`                          | Elements for products single pages.                                                                                                                                   |
| `install`                                    | [Content Import Format](https://documentation.concretecms.org/developers/pages-themes/designing-for-concrete5/packaging-your-theme/enabling-full-content-swap) files. |
| `single_pages/dashboard/products`            | Single page views to manage Doctrine Entries.                                                                                                                         |
| `src/Entity`                                 | Doctrines Entities                                                                                                                                                    |
| `src/File`                                   | Custom External File Provider                                                                                                                                         |
| `src/Poke`                                   | Custom Classes for REST API                                                                                                                                           |
| `src/Search`                                 | Custom ItemList classes                                                                                                                                               |
| `themes/theme_boilerplate`                   | A sample custom theme.                                                                                                                                                |
