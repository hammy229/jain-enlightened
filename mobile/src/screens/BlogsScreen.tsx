import {
  ActivityIndicator,
  FlatList,
  Image,
  RefreshControl,
  ScrollView,
  StyleSheet,
  View,
} from 'react-native';

import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import BlogCard from '../components/cards/BlogCard';
import { fetchBlogs } from '../api/api';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Loader from '../components/Loader';
import { NoData } from '../assets/images';

const renderBlogs = ({ item }) => (
  <BlogCard
    id={item.id}
    title={item.heading}
    author={item.blog_by}
    description={item.short_description}
    image={item.blog_img_path}
  />
);

const BlogsScreen = () => {
  const [blogs, setBlogs] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  const getBaseUrlAndBlogs = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const blogsData = await fetchBlogs(url);
        setBlogs(blogsData);
      } else {
        console.log('Base URL not found in AsyncStorage');
      }
    } catch (error) {
      console.log('Error fetching base URL or blogs: ', error);
    } finally {
      setLoading(false);
    }
  };

  const onRefresh = async () => {
    setRefreshing(true);
    await getBaseUrlAndBlogs();
    setRefreshing(false);
  };

  useEffect(() => {
    getBaseUrlAndBlogs();
  }, []);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* Blogs Header */}
      <SecondaryPageHeader title="Blogs" />

      {/* Blogs List */}

      {blogs.length > 0 ? (
        <FlatList
          refreshControl={
            <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
          }
          data={blogs}
          keyExtractor={(item) => item.id}
          renderItem={renderBlogs}
          contentContainerStyle={[globalStyles.padVertical]}
        />
      ) : (
        <ScrollView
          refreshControl={
            <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
          }
          contentContainerStyle={styles.NoDataView}>
          <Image
            source={NoData}
            style={{ height: 200, width: '100%', resizeMode: 'contain' }}
          />
        </ScrollView>
      )}
    </LayoutWrapper>
  );
};

export default BlogsScreen;

const styles = StyleSheet.create({
  NoDataView: {
    flex: 1,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
