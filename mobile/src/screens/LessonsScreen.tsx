import {
  View,
  FlatList,
  Text,
  ScrollView,
  Image,
  StyleSheet,
  RefreshControl,
} from 'react-native';
import React, { useCallback, useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import { globalStyles } from '../assets/styles/globalStyles';
import CustomDropdown from '../components/Dropdown';
import LessonCard from '../components/cards/LessonCard';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchLessons } from '../api/api';
import Loader from '../components/Loader';
import {
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import { NoData } from '../assets/images';

const LessonsScreen = () => {
  const route = useRoute();
  const navigation = useNavigation();
  const { id } = route.params || {};
  const handleSelect = (selected: string) => {};
  const [refreshing, setRefreshing] = useState(false);
  const [lessons, setLessons] = useState([]);
  const [filteredLessons, setFilteredLessons] = useState(lessons);
  const [language, setLanguage] = useState();
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (id) {
      navigation.navigate('LessonDetails', { id: id });
    }
  }, [id, navigation]);

  const handleLanguageSelect = (selectedLanguage) => {
    if (selectedLanguage.id === 0) {
      setFilteredLessons(lessons);
    } else {
      const filtered = lessons.filter(
        (item) => item.language_id === selectedLanguage.id.toString(),
      );
      setFilteredLessons(filtered);
    }
  };

  const getLessons = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchLessons(url);
        setLessons(response.lessons);
        setLanguage(response.languages);
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
    await getLessons();
    setRefreshing(false);
  };

  useFocusEffect(
    useCallback(() => {
      getLessons();
    }, []),
  );

  useEffect(() => {
    setFilteredLessons(lessons);
  }, [lessons]);

  if (loading) {
    return <Loader />;
  }

  const renderLessons = ({ item, index }) => (
    <LessonCard
      id={item.id}
      title={item.heading}
      description={item.lesson_description}
      image={item.lesson_img_path}
      index={index}
      totalCount={filteredLessons.length}
    />
  );

  return (
    <LayoutWrapper>
      {/* Lessons Header */}
      <SecondaryPageHeader title="Lessons" borderRadius={0} />

      {/* Searchbar */}
      <View
        style={[
          globalStyles.padHorizontal,
          {
            backgroundColor: '#1D515E',
            borderBottomLeftRadius: 14,
            borderBottomRightRadius: 14,
          },
        ]}>
        <CustomDropdown
          options={language}
          onSelect={handleLanguageSelect}
          selectedLanguage={language ? language[0] : null}
        />
      </View>

      {/* Lessons list */}
      {filteredLessons.length > 0 ? (
        <FlatList
          refreshControl={
            <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
          }
          data={filteredLessons}
          keyExtractor={(item) => item.id}
          renderItem={renderLessons}
          contentContainerStyle={[
            globalStyles.padHorizontal,
            globalStyles.padVertical,
          ]}
        />
      ) : (
        <ScrollView
          refreshControl={
            <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
          }
          contentContainerStyle={{
            flex: 1,
          }}>
          <View style={styles.NoDataView}>
            <Image
              source={NoData}
              style={{ height: 200, width: '100%', resizeMode: 'contain' }}
            />
          </View>
        </ScrollView>
      )}
    </LayoutWrapper>
  );
};

export default LessonsScreen;

const styles = StyleSheet.create({
  NoDataView: {
    flex: 1,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
