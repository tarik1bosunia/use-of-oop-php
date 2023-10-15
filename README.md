# project description
```text
Create 2 Class Named "Book" and "Customer" in there respective files with properties as below

Book
 - isbn : int
 - title : string
 - author : string
 - available : int
 + getCopy() : bool
 + addCopy(int num) : bool


 Customer
 - id (int)
 - firstName (string)
 - lastName (string)
 - email (string)


 write constructor , getters[ie. getTitle() etc ] and setters [ie. setEmail("a@b.com") ] for both classes and implement __toString method to print object.

 Extra point if you can use __call, __get and __set method to implement getter and setter.

Now create a separate php file to manipulate those classes and show output.
```

# Tailwind Integration guide

### install & initialization tailwind css
```bash
npm install -D tailwindcss
npx tailwindcss init
```
### need to edit tailwind.config.js
```code
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{php,html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

### add a 2 files file input.css & style.css
### in input.css write
```code
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### link style.css file in index.php
```code
<link rel="stylesheet" href="style.css">
```

### run tailwind server
```bash
npx tailwindcss -i ./input.css -o ./style.css --watch
```