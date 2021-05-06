![Kristine](docs/img/kristine.jpg)

![version](https://img.shields.io/badge/version-0.0.1%20Alpha-ff69b4.svg?longCache=true&style=for-the-badge)

# Kristine
Kristine is a simple discussion forum you can easily customize to make as unique as your community.

Check the [Development Branch](https://github.com/cadox8/Kristine/tree/develop) or the [PHP Branch](https://github.com/cadox8/Kristine/tree/php) (Outdated).

## Table Of Content
- [Features](#features)
- [Demo](#demo)
- [Installation](#installation)
- [Configuration](#configuration)  
- [Changelog](/CHANGELOG.md)
- [Images](#images)
- [PHP Version](#php-version)
- [License](#license)

## Features
- [ ] Forum System
    - [ ] Create/Edit/Delete forums and sub-forums
    - [ ] Access control [Permissions]
    - [ ] Custom Icons
    - [ ] Posts
        - [ ] Comments
        - [ ] Edit/Delete
        - [ ] Lock
        - [ ] Sticky
- [ ] Users System
    - [ ] Create/Delete Users
    - [ ] Profile
        - [ ] Comments
        - [ ] Configuration
        - [ ] Customization
        - [ ] Privacy
    - [ ] Verify account
    - [ ] Direct Messages
    - [ ] Badges
    - [ ] Achievements
    - [ ] Points
- Admin System
    - [ ] Manage Forums
    - [ ] Manage Posts
    - [ ] Manage Users
    - [ ] Manage Forum configuration
- [ ] Permissions
  - [ ] Permissions per group
  - [ ] Permissions per user  
  - [ ] Create/Delete new group
  - [ ] Edit Group/User permissions
- [ ] Translations
- [ ] Installation Script
- [ ] API
- [ ] Themes
- [ ] Addons

A lot of things more, it's only an Alpha.

## Demo
You can check the demo [here](https://cadox8.es/kristine).

**Username**: `kristine`

**Password**: `kristine`

## Installation

### Requisites
- [Node >= v14.X](https://nodejs.org/es/download/)
- [NPM](https://nodejs.org/es/download/)
- [MongoDB](https://www.mongodb.com/try/download/community)

### Using Git
- Clone the repository:
```bash
git clone https://github.com/cadox8/kristine.git Kristine
```
- Enter into the folder and install all the dependencies:
```bash
cd Kristine
npm install
```
- Go to [Configuration](#configuration)

### Downloading files
- Download `Kristine-vX.X.X.zip` from the [Downloads section](https://github.com/cadox8/Kristine/releases)
- Unzip the file, enter into the folder and install all the dependencies:
```bash
npm install
```
- Go to [Configuration](#configuration)

## Configuration
- Start the forum with `npm run start`
- Open your favourite web browser and join the domain you installed Kristine on
    - `yourdomain.com/install`
    - `yourdomain.com/kristine/install`
    - `localhost/install`
    - ...
- Follow the configuration script
- Enjoy your new forum!

**WARNING**: The **port** by default is `3000`. If you're installing this forum without anything else, you show change the port to 80.

I recommend using this forum behind a reverse proxy (apache or nginx).

You can update your port (and some other config) by editing `defaults.json` [`config/defaults.json`].

## Images
Not yet

### PHP Version
An older version of this Forum made in PHP can be found [here](https://github.com/cadox8/Kristine/tree/php).

**WARNING**: This version is discontinued and won't be updated anymore.

## License
This project is released under [GNU LICENSE](https://github.com/cadox8/Kristine/blob/master/LICENSE).