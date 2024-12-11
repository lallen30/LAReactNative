import React from 'react';
import { View, Text, TouchableOpacity, ScrollView } from 'react-native';
import { styles } from './Styles';

const BluestoneAppsAIScreen = ({ navigation }: any) => {
  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Bluestone Apps AI</Text>
      </View>

      <View style={styles.content}>
        <Text style={styles.description}>
          Welcome to Bluestone Apps AI Assistant. Here you can interact with our AI system.
        </Text>

        <View style={styles.featuresContainer}>
          <TouchableOpacity style={styles.featureCard}>
            <Text style={styles.featureTitle}>Chat with AI</Text>
            <Text style={styles.featureDescription}>Start a conversation with our AI assistant</Text>
          </TouchableOpacity>

          <TouchableOpacity style={styles.featureCard}>
            <Text style={styles.featureTitle}>AI Tools</Text>
            <Text style={styles.featureDescription}>Access our suite of AI-powered tools</Text>
          </TouchableOpacity>
        </View>
      </View>
    </ScrollView>
  );
};

export default BluestoneAppsAIScreen;
