Place your theme language files in this directory.

Please visit the following links to learn more about translating WordPress themes:

+ https://make.wordpress.org/polyglots/teams/
+ https://developer.wordpress.org/themes/functionality/localization/
+ https://developer.wordpress.org/reference/functions/load_theme_textdomain/

## How to regenerate the language files

*->* _assuming that `hello` is the final text domain_

1. Remove (and backup) the `.mo` files
2. Concat all the `.pot` files to `hello.pot`
3. Concat all the `.po` files to their corresponding lang file  
( eg. `sage-fr_FR.po` + `tgmpa-fr_FR.po` -> `fr_FR.po` )
4. Open `hello.pot` in Poedit
5. *OR* Load a lang file in Poedit ( eg. `fr_FR.po` )
6. _Complete the missing translations ... or not_
8. Generate the corresponding `.mo` file ( eg. `fr_FR.mo` )
9. Reapeat from *5* for each lang


---

> TODO : configure gulp & asset-builder to concat the files

> cf. `./manifest.json`

> [documentation](
  http://use-asset-builder.austinpray.com/
)
