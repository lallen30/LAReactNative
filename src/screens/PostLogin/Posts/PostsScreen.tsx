import React from 'react';
import { View, Text, TouchableOpacity, ScrollView, Image } from 'react-native';
import { styles } from './Styles';

const PostsScreen = ({ navigation }: any) => {
  const dummyPosts = [
    {
      id: 1,
      title: 'Welcome to Our New App',
      content: "We're excited to announce our new mobile application...",
      date: '2023-11-19',
      author: 'Admin',
    },
    {
      id: 2,
      title: 'Latest Updates and Features',
      content: "Check out the newest features we've added to improve your experience...",
      date: '2023-11-18',
      author: 'Team Lead',
    },
  ];

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Posts</Text>
      </View>

      <View style={styles.postsContainer}>
        {dummyPosts.map(post => (
          <TouchableOpacity key={post.id} style={styles.postCard}>
            <Text style={styles.postTitle}>{post.title}</Text>
            <Text style={styles.postContent}>{post.content}</Text>
            <View style={styles.postFooter}>
              <Text style={styles.postDate}>{post.date}</Text>
              <Text style={styles.postAuthor}>By {post.author}</Text>
            </View>
          </TouchableOpacity>
        ))}
      </View>

      <TouchableOpacity style={styles.createButton}>
        <Text style={styles.createButtonText}>Create New Post</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

export default PostsScreen;
