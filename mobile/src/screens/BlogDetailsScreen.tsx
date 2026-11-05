import {
  View,
  Text,
  Image,
  ScrollView,
  StyleSheet,
  FlatList,
} from 'react-native';
import React, { useEffect, useRef, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import { Date, User } from '../assets/images';
import BlogCard from '../components/cards/BlogCard2';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchBlogDetails } from '../api/api';
import Loader from '../components/Loader';
import { RouteProp } from '@react-navigation/native';
import moment from 'moment';
import HTML from 'react-native-render-html';

type BlogDetailsRouteProp = RouteProp<
  { BlogDetails: { id: number } },
  'BlogDetails'
>;

interface BlogDetailsProps {
  route: BlogDetailsRouteProp;
}

const renderBlogCard2 = ({ item }) => (
  <BlogCard
    id={item.id}
    title={item.heading}
    author={item.blog_by}
    image={item.blog_img_path}
  />
);

const BlogDetailsScreen: React.FC<BlogDetailsProps> = ({ route }) => {
  const id = route.params.id;
  const [blogDetails, setBlogDetails] = useState();
  const [latestBlogs, setLatestBlogs] = useState();
  const [loading, setLoading] = useState(true);
  const scrollViewRef = useRef<ScrollView | null>(null);
  const formattedDate = moment(blogDetails?.date).format('DD MMMM YYYY');

  useEffect(() => {
    const getBaseUrlAndBlogs = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const blogDetails = await fetchBlogDetails(url, id);
          setBlogDetails(blogDetails.blog);
          setLatestBlogs(blogDetails.latest_blogs);

          if (scrollViewRef.current) {
            scrollViewRef.current.scrollTo({ y: 0, animated: true });
          }
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching base URL or blogs: ', error);
      } finally {
        setLoading(false);
      }
    };

    getBaseUrlAndBlogs();
  }, [id]);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* Blog Details Header */}
      <SecondaryPageHeader title="Blog Details" borderRadius={0} />

      {/* Blog Image */}
      <View
        style={[
          globalStyles.padHorizontal,
          {
            backgroundColor: '#1D515E',
            borderBottomLeftRadius: 14,
            borderBottomRightRadius: 14,
            paddingBottom: 20,
          },
        ]}>
        <Image
          source={{ uri: blogDetails?.blog_img_path }}
          style={{
            height: 190,
            width: '100%',
            objectFit: 'cover',
            borderRadius: 7,
          }}
        />
      </View>

      <ScrollView style={globalStyles.bgWhite} ref={scrollViewRef}>
        <View style={[globalStyles.padHorizontal, globalStyles.padVertical]}>
          <Text style={styles.title}>{blogDetails?.heading}</Text>
          <View
            style={{
              flexDirection: 'row',
              alignItems: 'center',
              justifyContent: 'space-between',
              paddingBottom: 20,
              marginBottom: 20,
              borderBottomColor: '#D9D9D9',
              borderBottomWidth: 1,
            }}>
            <View
              style={{
                marginTop: 5,
                flexDirection: 'row',
                alignItems: 'center',
                gap: 5,
                width: '55%',
              }}>
              <Image
                source={User}
                style={{
                  alignSelf: 'flex-start',
                  height: 16,
                  width: 16,
                  objectFit: 'contain',
                }}
              />
              <Text
                style={{ fontFamily: fonts.OpenSansSemiBold, fontSize: 13 }}
                ellipsizeMode="tail">
                {blogDetails?.blog_by}
              </Text>
            </View>
            {formattedDate == 'Invalid date' ? null : (
              <View
                style={{
                  marginTop: 5,
                  flexDirection: 'row',
                  alignItems: 'center',
                  alignSelf: 'flex-start',
                  gap: 5,
                }}>
                <Image
                  source={Date}
                  style={{
                    height: 14,
                    width: 14,
                    objectFit: 'contain',
                  }}
                />
                <Text
                  style={{
                    fontFamily: fonts.OpenSansSemiBold,
                    fontSize: 13,
                  }}>
                  {formattedDate}
                </Text>
              </View>
            )}
          </View>
          <HTML
            source={{ html: blogDetails?.description }}
            contentWidth={1000}
          />
        </View>
        {latestBlogs && latestBlogs.length > 0 && (
          <View>
            <View style={styles.blueView}>
              <Text style={globalStyles.sectionTitleBlack}>
                Latest <Text style={globalStyles.sectionTitleBlue}>Blogs</Text>
              </Text>
            </View>
            <View style={styles.horizontalScrollPad}>
              <FlatList
                data={latestBlogs}
                horizontal
                showsHorizontalScrollIndicator={false}
                renderItem={renderBlogCard2}
                keyExtractor={(item) => item.id}
              />
            </View>
          </View>
        )}
      </ScrollView>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  title: {
    fontSize: 15,
    fontFamily: fonts.JakartaBold,
    color: '#303030',
  },
  blueView: {
    backgroundColor: '#F0F5FF',
    padding: 15,
  },
  horizontalScrollPad: {
    paddingLeft: 15,
    backgroundColor: '#F0F5FF',
  },
});

export default BlogDetailsScreen;
