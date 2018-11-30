# db-project

## TODO

* ~~re-do entity filtering when Editing Medium [Combat|Rescue|Support]~~
* ~~delete rescue process when no Emergency Events left associated with that process~~
* add dropdowns when:
	* ~~inserting emergency event: place dropdown~~
	* ~~inserting medium: entity dropdown~~

```bash

.
├── populate.sql
├── queries.sql
├── README.md
├── schema.sql
├── tree.txt
├── triggers.sql
└── web
    ├── action
    │   ├── assoc
    │   │   ├── process-event.php
    │   │   └── process-medium.php
    │   ├── delete
    │   │   ├── emergency-event.php
    │   │   ├── entity.php
    │   │   ├── medium-combat.php
    │   │   ├── medium.php
    │   │   ├── medium-rescue.php
    │   │   ├── medium-support.php
    │   │   ├── place.php
    │   │   └── rescue-process.php
    │   ├── insert
    │   │   ├── emergency-event.php
    │   │   ├── entity.php
    │   │   ├── medium-combat.php
    │   │   ├── medium.php
    │   │   ├── medium-rescue.php
    │   │   ├── medium-support.php
    │   │   ├── place.php
    │   │   └── rescue-process.php
    │   ├── list
    │   │   ├── medium.php
    │   │   ├── medium-process.php
    │   │   ├── medium-rescue-place.php
    │   │   └── rescue-process.php
    │   └── update
    │       ├── medium-combat.php
    │       ├── medium-rescue.php
    │       └── medium-support.php
    ├── common
    │   ├── connect.php
    │   ├── helpers.php
    │   └── init.php
    ├── credentials.php
    ├── css
    │   └── style.css
    ├── index.html
    ├── js
    │   └── validateForm.js
    ├── login.html
    ├── map.php
    └── views
        ├── insert
        │   ├── emergency-event.view.php
        │   ├── entity.view.php
        │   ├── medium.view.php
        │   ├── place.view.php
        │   └── rescue-process.view.php
        ├── process-assoc.view.php
        ├── table
        │   ├── table-prompt.view.php
        │   └── table.view.php
        ├── table-dual.view.php
        ├── table-single-prompt.view.php
        ├── table-single.view.php
        └── update-medium.view.php

```

