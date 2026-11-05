import {
  View,
  Text,
  Pressable,
  StyleSheet,
  ScrollView,
  Image,
  RefreshControl,
} from 'react-native';
import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import {
  ColouredGallery,
  ColouredVideo,
  WhiteGallery,
  WhiteVideo,
} from '../assets/images';
import PhotosScreen from './PhotosScreen';
import VideosScreen from './VideosScreen';
import Loader from '../components/Loader';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchGallery } from '../api/api';

const GalleryScreen = () => {
  const [selectedTab, setSelectedTab] = useState(0);
  const [photoGallery, setPhotoGallery] = useState([]);
  const [videoGallery, setVideoGallery] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  const getGalleryItems = async (slug) => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const galleries = await fetchGallery(url, slug);
        if (slug === 'image') {
          setPhotoGallery(galleries);
        } else if (slug === 'video') {
          setVideoGallery(galleries);
        }
      } else {
        console.log('Base URL not found in AsyncStorage');
      }
    } catch (error) {
      console.log('Error fetching base URL or galleries: ', error);
    } finally {
      setLoading(false);
    }
  };
  const onRefresh = async () => {
    setRefreshing(true);
    if (selectedTab === 0) {
      await getGalleryItems('image');
    } else {
      await getGalleryItems('video');
    }
    setRefreshing(false);
  };

  useEffect(() => {
    setLoading(true);
    if (selectedTab === 0) {
      getGalleryItems('image');
    } else {
      getGalleryItems('video');
    }
  }, [selectedTab]);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* Gallery Header */}
      <SecondaryPageHeader title="Gallery" />
      <View style={globalStyles.padHorizontal}>
        <View style={styles.PressableBtn}>
          <Pressable
            onPress={() => setSelectedTab(0)}
            style={[
              styles.GalleryBtn,
              { backgroundColor: selectedTab === 0 ? '#0D677D' : '#E9F1F3' },
            ]}>
            <View style={{ flexDirection: 'row' }}>
              <Text
                style={[
                  styles.GalleryBtnText,
                  {
                    color: selectedTab === 0 ? '#FFF' : '#0D677D',
                  },
                ]}>
                Photos
              </Text>
              <Image
                source={selectedTab === 0 ? WhiteGallery : ColouredGallery}
                style={{ height: 17, width: 17, marginLeft: 10 }}
              />
            </View>
          </Pressable>
          <Pressable
            style={[
              styles.GalleryBtn,
              {
                backgroundColor: selectedTab === 1 ? '#0D677D' : '#E9F1F3',
              },
            ]}
            onPress={() => setSelectedTab(1)}>
            <View style={{ flexDirection: 'row' }}>
              <Text
                style={[
                  styles.GalleryBtnText,
                  { color: selectedTab === 1 ? '#FFF' : '#0D677D' },
                ]}>
                Videos
              </Text>
              <Image
                source={selectedTab === 1 ? WhiteVideo : ColouredVideo}
                style={{ height: 18, width: 18, marginLeft: 10 }}
              />
            </View>
          </Pressable>
        </View>
      </View>
      <ScrollView
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        style={[
          globalStyles.padHorizontal,
          // globalStyles.padVertical,
          globalStyles.bgWhite,
        ]}>
        <View style={{ flex: 1 }}>
          {selectedTab === 0 ? (
            <PhotosScreen data={photoGallery} />
          ) : (
            <VideosScreen data={videoGallery} />
          )}
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

export default GalleryScreen;

const styles = StyleSheet.create({
  PressableBtn: {
    flexDirection: 'row',
    alignSelf: 'center',
    justifyContent: 'center',
    alignItems: 'center',
    width: '100%',
    height: 46,
    backgroundColor: '#E9F1F3',
    borderRadius: 6,
    padding: 2,
    marginTop: 20,
  },
  GalleryBtn: {
    height: 34,
    width: '48%',
    justifyContent: 'center',
    alignItems: 'center',
    borderRadius: 3,
  },
  GalleryBtnText: {
    fontSize: 13,
  },
});
