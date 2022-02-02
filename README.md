Installation
------------

The preferred way to install this extension is through [node.js](https://nodejs.org/en/download/).

Run console command

```
npm install
```

Downloaded in the `package.json`

```
"bootstrap": "^5.1.3",
```

```
"normalize.css": "^8.0.1"
```

to the require section of your `package.json` file.

The csv file is processed and saved in the download folder, and an error report is made on it and immediately saved to the user

All the mechanics are described in the file download.php

Create Table
```
"CREATE TABLE product
( Код int NOT NULL UNIQUE,
  Название varchar(211) NOT NULL
);"
```
