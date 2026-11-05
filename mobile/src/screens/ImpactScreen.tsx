import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  Image,
  FlatList,
  StyleSheet,
  RefreshControl,
} from 'react-native';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { fonts } from '../assets/fonts';
import { globalStyles } from '../assets/styles/globalStyles';
import { ScrollView } from 'react-native-gesture-handler';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchImpacts } from '../api/api';
import Loader from '../components/Loader';
import { NoData } from '../assets/images';

const ImpactScreen = () => {
  const [impacts, setImpacts] = useState([]);
  const [loading, setLoading] = useState(false);
  const [refreshing, setRefreshing] = useState(false);

  const getImpactList = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchImpacts(url);
        setImpacts(response);
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
    await getImpactList();
    setRefreshing(false);
  };

  useEffect(() => {
    getImpactList();
  }, []);

  if (loading) {
    return <Loader />;
  }

  const renderImpact = ({ item }) => (
    <View style={globalStyles.padHorizontal}>
      <View style={[styles.card, globalStyles.cardShadow]}>
        <View style={styles.leftBorder} />
        <Image source={{ uri: item?.imptact_img_path }} style={styles.image} />
        <View style={styles.textContainer}>
          <Text style={styles.title}>{item.heading}</Text>
          <Text style={styles.description}>{item.description}</Text>
        </View>
      </View>
    </View>
  );

  return (
    <LayoutWrapper>
      {/* Impact Header */}
      <SecondaryPageHeader title="Impact" />

      <View nestedScrollEnabled style={styles.container}>
        {impacts.length > 0 ? (
          <>
            <Text
              style={[
                globalStyles.sectionTitleBlack,
                globalStyles.padHorizontal,
                globalStyles.padVertical,
              ]}>
              What{' '}
              <Text style={globalStyles.sectionTitleBlue}>have we done?</Text>
            </Text>

            <FlatList
              refreshControl={
                <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
              }
              data={impacts}
              renderItem={renderImpact}
              keyExtractor={(item) => item.id}
              contentContainerStyle={styles.list}
            />
          </>
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
      </View>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  list: {
    paddingBottom: 16,
  },
  card: {
    flexDirection: 'row',
    backgroundColor: '#FFFFFF',
    borderRadius: 8,
    padding: 10,
    paddingLeft: -10,
    marginBottom: 12,
  },
  image: {
    width: 100,
    height: 85,
    objectFit: 'contain',
    borderRadius: 8,
    marginRight: 12,
  },
  textContainer: {
    flex: 1,
  },
  title: {
    fontSize: 16,
    fontFamily: fonts.JakartaSemiBold,
    color: '#167E98',
  },
  description: {
    fontSize: 14,
    color: '#000',
    fontFamily: fonts.JakartaRegular,
  },
  leftBorder: {
    backgroundColor: '#167E98',
    width: 5,
    borderTopRightRadius: 8,
    borderBottomRightRadius: 8,
    marginRight: 10,
    height: 85,
  },
  NoDataView: {
    flex: 1,
    height: 660,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default ImpactScreen;
