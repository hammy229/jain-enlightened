import {
  FlatList,
  Image,
  RefreshControl,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import { globalStyles } from '../assets/styles/globalStyles';
import PodcastCard from '../components/cards/PodcastCard';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchPodcasts } from '../api/api';
import Loader from '../components/Loader';
import { NoData } from '../assets/images';

const renderPodcast = ({ item }) => (
  <PodcastCard
    title={item.heading}
    image={item.podcast_img_path}
    ytLink={item.youtube_url}
  />
);

const PodcastScreen = () => {
  const [podcasts, setPodcasts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  const getPodcasts = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchPodcasts(url);
        setPodcasts(response);
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
    await getPodcasts();
    setRefreshing(false);
  };

  useEffect(() => {
    getPodcasts();
  }, []);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* Podcasts Header */}
      <SecondaryPageHeader title="Podcast" />

      {/* Podcast List */}

      {podcasts.length > 0 ? (
        <FlatList
          refreshControl={
            <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
          }
          data={podcasts}
          keyExtractor={(item) => item.id}
          renderItem={renderPodcast}
          contentContainerStyle={[
            globalStyles.padVertical,
            globalStyles.bgWhite,
          ]}
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

export default PodcastScreen;

const styles = StyleSheet.create({
  NoDataView: {
    flex: 1,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
