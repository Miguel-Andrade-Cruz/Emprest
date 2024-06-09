## What is Emprest?
Emprest is my personal project made to study automated tests and the SOLID concept together. It is a basic banking system, with three different banks (for now), and some features that will be shown soon. 

### Why create Emprest?
Long story short, to show and to pratice. I´m a student from the brazillian online school Alura, to reach my first job and in the future become a Teacher. To do that, I think the best way is always pratice, so this is why all these projects are in my public repository. 

### File System
To find the files in this project, just look at how I made the Architecture

> NOTE:  At this moment, this architecture don't follow any pattern, it is just what I think that should be easy to expand and find files.

### The CDS pattern
Basically, all the classes has three main sections: The **Concept**, where I stored the interface code, the **Structure**, where I made the main class that works with the fundamental features, and finally **Derivatives**, Where child classes stay, following almost the same rules, with some little changes:

> NOTE: The main folder need to have the same name of the class, to work with composer.

 - If the child class can have childs, the CSD pattern remain the same.
 - If not, you can create the class inside without specific folders.

 ## Develop on Emprest
To ensure that your improvement on Emprest will work, Follow the instructions below to:
 - Add a new bank;
 - Create a new account type;
 - Create a new Client type;

### Adding a new bank

 1. Go to  src/model/Bank/Derivatives and create a new folder with the name ofyour bank.

 2. Import the classes `Manager` and `Bank` to your file.

 3. Add the `BANK_ID`,  `Manager` and `Safe`  properties.
 
 4. Instanciate a `Manager` on the construct method.
 
 5. Add the new features you want.