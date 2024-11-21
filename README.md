This is a new [**React Native**](https://reactnative.dev) project, bootstrapped using [`@react-native-community/cli`](https://github.com/react-native-community/cli).

# Getting Started

> **Note**: Make sure you have completed the [React Native - Environment Setup](https://reactnative.dev/docs/environment-setup) instructions till "Creating a new application" step, before proceeding.

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

If you can't get this to work, see the [Troubleshooting](https://reactnative.dev/docs/troubleshooting) page.

# Learn More

To learn more about React Native, take a look at the following resources:

- [React Native Website](https://reactnative.dev) - learn more about React Native.
- [Getting Started](https://reactnative.dev/docs/environment-setup) - an **overview** of React Native and how setup your environment.
- [Learn the Basics](https://reactnative.dev/docs/getting-started) - a **guided tour** of the React Native **basics**.
- [Blog](https://reactnative.dev/blog) - read the latest official React Native **Blog** posts.
- [`@facebook/react-native`](https://github.com/facebook/react-native) - the Open Source; GitHub **repository** for React Native.

# ReanimatedVersion Error

- replace /node_modules/react-native-reanimated/Common/cpp/worklets/Tools/ReanimatedVersion.cpp with this code:

```
#include <worklets/Tools/JSLogger.h>
#include <worklets/Tools/ReanimatedVersion.h>

#include <memory>
#include <regex>
#include <string>

// Ensure REANIMATED_VERSION_STRING is always defined
#ifndef REANIMATED_VERSION
#define REANIMATED_VERSION "3.16.2" // Replace with the correct version
#endif

#define STRINGIZE(x) #x
#define STRINGIZE2(x) STRINGIZE(x)
#define REANIMATED_VERSION_STRING STRINGIZE2(REANIMATED_VERSION)

using namespace facebook;

namespace worklets {

std::string getReanimatedCppVersion() {
  return std::string(REANIMATED_VERSION_STRING);
}

void injectReanimatedCppVersion(jsi::Runtime &rnRuntime) {
  auto version = getReanimatedCppVersion();
  rnRuntime.global().setProperty(
      rnRuntime,
      "_REANIMATED_VERSION_CPP",
      jsi::String::createFromUtf8(rnRuntime, version));
}

#ifndef NDEBUG
// This function is pretty much a copy of
// `src/reanimated2/platform-specific/checkVersion.ts`.
bool matchVersion(const std::string &version1, const std::string &version2) {
  std::regex pattern("^\\d+\\.\\d+\\.\\d+$");
  if (std::regex_match(version1, pattern) &&
      std::regex_match(version2, pattern)) {
    auto majorPattern = std::regex("^\\d+");
    auto major1 = std::regex_search(version1, majorPattern);
    auto major2 = std::regex_search(version2, majorPattern);
    if (major1 != major2) {
      return false;
    }
    auto minorPattern = std::regex("\\.\\d+\\.");
    auto minor1 = std::regex_search(version1, minorPattern);
    auto minor2 = std::regex_search(version2, minorPattern);
    if (minor1 != minor2) {
      return false;
    }
    return true;
  } else {
    return version1 == version2;
  }
}

void checkJSVersion(
    jsi::Runtime &rnRuntime,
    const std::shared_ptr<JSLogger> &jsLogger) {
  auto cppVersion = getReanimatedCppVersion();

  auto maybeJSVersion =
      rnRuntime.global().getProperty(rnRuntime, "_REANIMATED_VERSION_JS");
  if (maybeJSVersion.isUndefined()) {
    jsLogger->warnOnJS(
        std::string(
            "[Reanimated] C++ side failed to resolve JavaScript code version\n") +
        "See `https://docs.swmansion.com/react-native-reanimated/docs/guides/troubleshooting#c-side-failed-to-resolve-javascript-code-version` for more details.");
    return;
  }

  auto jsVersion = maybeJSVersion.asString(rnRuntime).utf8(rnRuntime);

  if (!matchVersion(cppVersion, jsVersion)) {
    jsLogger->warnOnJS(
        std::string(
            "[Reanimated] Mismatch between C++ code version and JavaScript code version (") +
        cppVersion + " vs. " + jsVersion + " respectively).\n" +
        "See `https://docs.swmansion.com/react-native-reanimated/docs/guides/troubleshooting#mismatch-between-c-code-version-and-javascript-code-version` for more details.");
    return;
  }
}
#else
void checkJSVersion(
    jsi::Runtime &rnRuntime,
    const std::shared_ptr<JSLogger> &jsLogger) {
  // In release builds we don't check the version, hence
  // this function is a NOOP.
}

bool matchVersion(const std::string &version1, const std::string &version2) {
  // Stub implementation for release builds.
  return true;
}
#endif // NDEBUG

}; // namespace worklets
```
