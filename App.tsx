import React, { useEffect, useState } from 'react';
import { View, Image, StyleSheet, Text, Dimensions } from 'react-native';
import AppNavigator from './src/navigation/AppNavigator';

// Get screen dimensions
const { width, height } = Dimensions.get('window');

function App(): React.JSX.Element {
  const [isLoading, setIsLoading] = useState(true);
  const [imageError, setImageError] = useState<string | null>(null);

  useEffect(() => {
    setTimeout(() => {
      setIsLoading(false);
    }, 2000);
  }, []);

  if (isLoading) {
    return (
      <View style={styles.splashContainer}>
        <Image
          source={require('./src/assets/images/splash/splash.png')}
          style={styles.splashImage}
          resizeMode="contain"
          onError={(error) => {
            console.log('Image loading error:', error.nativeEvent.error);
            setImageError(error.nativeEvent.error);
          }}
          onLoad={() => console.log('Image loaded successfully')}
        />
        {imageError && (
          <Text style={styles.errorText}>
            Error loading image: {imageError}
          </Text>
        )}
      </View>
    );
  }

  return <AppNavigator />;
}

const styles = StyleSheet.create({
  splashContainer: {
    flex: 1,
    backgroundColor: '#fff',
    justifyContent: 'center',
    alignItems: 'center',
    width: width,
    height: height,
  },
  splashImage: {
    width: width * 0.8,  // 80% of screen width
    height: height * 0.8, // 80% of screen height
    resizeMode: 'contain',
  },
  errorText: {
    color: 'red',
    marginTop: 10,
  },
});

export default App;
