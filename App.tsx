import React, { useEffect, useState } from 'react';
import { View, Image, StyleSheet, Text, Dimensions } from 'react-native';
import AppNavigator from './src/navigation/AppNavigator';

// Get screen dimensions
const { width, height } = Dimensions.get('window');

function App(): React.JSX.Element {
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    setTimeout(() => {
      setIsLoading(false);
    }, 2000);
  }, []);

  if (isLoading) {
    return (
      <View style={styles.splashContainer}>
        <View style={styles.placeholderImage}>
          <Text style={styles.placeholderText}>Loading...</Text>
        </View>
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
  placeholderImage: {
    width: width * 0.8,
    height: height * 0.8,
    backgroundColor: '#f0f0f0',
    justifyContent: 'center',
    alignItems: 'center',
    borderRadius: 10,
  },
  placeholderText: {
    fontSize: 24,
    color: '#333',
  },
});

export default App;
