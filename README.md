# LAReactNative

A React Native mobile application with features including calendar events, posts, and more.

## Prerequisites

- Node.js (v23 recommended)
- React Native CLI
- Xcode (for iOS development)
- Android Studio (for Android development)
- Watchman

## Environment Setup

Before running the project, make sure to set the file descriptor limit:

```bash
ulimit -n 1048575
```

## Installation

1. Clone the repository
2. Install dependencies:
```bash
npm install
# or
yarn install
```

## Key Features

- Calendar with event management
- Post creation and viewing
- Navigation drawer
- Async storage for data persistence
- API integration with axios

## Project Structure

- `/src`: Main source code
  - `/screens`: Application screens
  - `/navigation`: Navigation configuration
  - `/theme`: Theme and styling
  - `/api`: API integration

## Dependencies

Key packages used in this project:
- react-native-calendars
- @react-navigation/drawer
- @react-native-async-storage/async-storage
- axios
- react-native-vector-icons

# Getting Started

>**Note**: Make sure you have completed the [React Native - Environment Setup](https://reactnative.dev/docs/environment-setup) instructions till "Creating a new application" step, before proceeding.

## Step 1: Start the Metro Server

First, you will need to start **Metro**, the JavaScript _bundler_ that ships _with_ React Native.

To start Metro, run the following command from the _root_ of your React Native project:

```bash
# using npm
npm start

# OR using Yarn
yarn start
```

## Step 2: Start your Application

Let Metro Bundler run in its _own_ terminal. Open a _new_ terminal from the _root_ of your React Native project. Run the following command to start your _Android_ or _iOS_ app:

### For Android

```bash
# using npm
npm run android

# OR using Yarn
yarn android
```

### For iOS

```bash
# using npm
npm run ios

# OR using Yarn
yarn ios
```

If everything is set up _correctly_, you should see your new app running in your _Android Emulator_ or _iOS Simulator_ shortly provided you have set up your emulator/simulator correctly.

This is one way to run your app — you can also run it directly from within Android Studio and Xcode respectively.

## Step 3: Modifying your App

Now that you have successfully run the app, let's modify it.

1. Open `App.tsx` in your text editor of choice and edit some lines.
2. For **Android**: Press the <kbd>R</kbd> key twice or select **"Reload"** from the **Developer Menu** (<kbd>Ctrl</kbd> + <kbd>M</kbd> (on Window and Linux) or <kbd>Cmd ⌘</kbd> + <kbd>M</kbd> (on macOS)) to see your changes!

   For **iOS**: Hit <kbd>Cmd ⌘</kbd> + <kbd>R</kbd> in your iOS Simulator to reload the app and see your changes!

## Congratulations! :tada:

You've successfully run and modified your React Native App. :partying_face:

### Now what?

- If you want to add this new React Native code to an existing application, check out the [Integration guide](https://reactnative.dev/docs/integration-with-existing-apps).
- If you're curious to learn more about React Native, check out the [Introduction to React Native](https://reactnative.dev/docs/getting-started).

# Troubleshooting

If you encounter the following issues:

1. Metro bundler cache issues:
```bash
watchman watch-del-all
npm start -- --reset-cache
```

2. For other common issues, refer to the [React Native Troubleshooting](https://reactnative.dev/docs/troubleshooting) guide.

# Learn More

To learn more about React Native, take a look at the following resources:

- [React Native Website](https://reactnative.dev) - learn more about React Native.
- [Getting Started](https://reactnative.dev/docs/environment-setup) - an **overview** of React Native and how setup your environment.
- [Learn the Basics](https://reactnative.dev/docs/getting-started) - a **guided tour** of the React Native **basics**.
- [Blog](https://reactnative.dev/blog) - read the latest official React Native **Blog** posts.
- [`@facebook/react-native`](https://github.com/facebook/react-native) - the Open Source; GitHub **repository** for React Native.
