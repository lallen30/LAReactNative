const {getDefaultConfig, mergeConfig} = require('@react-native/metro-config');
const path = require('path');

const defaultConfig = getDefaultConfig(__dirname);

module.exports = mergeConfig(defaultConfig, {
  transformer: {
    getTransformOptions: async () => ({
      transform: {
        experimentalImportSupport: false,
        inlineRequires: true,
      },
    }),
  },
  resolver: {
    assetExts: [...defaultConfig.resolver.assetExts],
    sourceExts: [...defaultConfig.resolver.sourceExts],
  },
  watchFolders: [
    // Only watch the project root folder
    path.resolve(__dirname),
  ],
  server: {
    enableWatchman: true,
  },
  projectRoot: path.resolve(__dirname),
  resolver: {
    blacklistRE: /node_modules\/(?!react-native|react-native-reanimated)/, // Ignore unnecessary modules
  },
});
