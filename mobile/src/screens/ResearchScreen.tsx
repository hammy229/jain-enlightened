import {
  View,
  Text,
  ScrollView,
  StyleSheet,
  Pressable,
  Image,
  Dimensions,
  RefreshControl,
} from 'react-native';
import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import ResearchCard from '../components/cards/ResearchCard';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchResearch } from '../api/api';
import Loader from '../components/Loader';
import { NoData } from '../assets/images';

const ResearchScreen = ({ route }) => {
  const routeRedirection = route.params;
  const [activeNav, setActiveNav] = useState(1);
  const [books, setBooks] = useState([]);
  const [educationalResources, setEducationalResources] = useState([]);
  const [academicResources, setAcademicResources] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  useEffect(() => {
    if (routeRedirection.section == 'Educational Resources') {
      setActiveNav(2);
    } else if (routeRedirection.section == 'Academic Resources') {
      setActiveNav(3);
    } else {
    }
  }, [routeRedirection]);

  const getResearchData = async (slug) => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const researchData = await fetchResearch(url, slug);
        if (slug === 'books_publishing') {
          setBooks(researchData);
        } else if (slug === 'educational_resources_board') {
          setEducationalResources(researchData);
        } else if (slug === 'academic_resources') {
          setAcademicResources(researchData);
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

  useEffect(() => {
    setLoading(true);
    if (activeNav === 1) {
      getResearchData('books_publishing');
    } else if (activeNav === 2) {
      getResearchData('educational_resources_board');
    } else if (activeNav === 3) {
      getResearchData('academic_resources');
    }
  }, [activeNav]);

  const onRefresh = async () => {
    setRefreshing(true);
    if (activeNav === 1) {
      await getResearchData('books_publishing');
    } else if (activeNav === 2) {
      await getResearchData('educational_resources_board');
    } else if (activeNav === 3) {
      await getResearchData('academic_resources');
    }
    setRefreshing(false);
  };

  // Determine which data to display based on the active tab
  const getCurrentData = () => {
    if (activeNav === 1) return books;
    if (activeNav === 2) return educationalResources;
    if (activeNav === 3) return academicResources;
    return [];
  };

  const currentData = getCurrentData();

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* Research Header */}
      <SecondaryPageHeader title="Research" />

      {/* Research List */}
      <ScrollView
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        showsVerticalScrollIndicator={false}
        style={[globalStyles.padVertical, globalStyles.bgWhite]}>
        <View style={styles.researchNavBox}>
          <Pressable
            onPress={() => setActiveNav(1)}
            style={
              activeNav === 1 ? styles.activeNavBtn : styles.inactiveNavBtn
            }>
            <Text
              style={
                activeNav === 1 ? styles.activeNavText : styles.inactiveNavText
              }>
              Books / {'\n'}Publishing
            </Text>
          </Pressable>
          <Pressable
            onPress={() => setActiveNav(2)}
            style={
              activeNav === 2 ? styles.activeNavBtn : styles.inactiveNavBtn
            }>
            <Text
              style={
                activeNav === 2 ? styles.activeNavText : styles.inactiveNavText
              }>
              Educational {'\n'} Resources
            </Text>
          </Pressable>
          <Pressable
            onPress={() => setActiveNav(3)}
            style={
              activeNav === 3 ? styles.activeNavBtn : styles.inactiveNavBtn
            }>
            <Text
              style={
                activeNav === 3 ? styles.activeNavText : styles.inactiveNavText
              }>
              Academic {'\n'} Resources
            </Text>
          </Pressable>
        </View>

        {/* Render Research Cards */}
        <View style={{ marginBottom: 20 }}>
          {currentData.length > 0 ? (
            currentData.map((item, index) => (
              <ResearchCard
                key={index}
                title={item.heading} // Adjust this according to your data structure
                description={item.description} // Adjust this according to your data structure
                image={item.research_img_path} // Default image if not available
                activeNav={activeNav}
                Link={item.research_url}
              />
            ))
          ) : (
            <ScrollView contentContainerStyle={styles.NoDataView}>
              <Image
                source={NoData}
                style={{ height: 200, width: '100%', resizeMode: 'contain' }}
              />
            </ScrollView>
          )}
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  researchNavBox: {
    backgroundColor: '#E9F1F3',
    borderRadius: 100,
    padding: 7,
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 20,
    marginHorizontal: 15,
  },
  activeNavBtn: {
    backgroundColor: '#0D677D',
    borderRadius: 100,
    paddingVertical: 5,
    paddingHorizontal: 15,
  },
  inactiveNavBtn: {
    backgroundColor: 'transparent',
    borderRadius: 100,
    paddingVertical: 5,
    paddingHorizontal: 15,
  },
  activeNavText: {
    textAlign: 'center',
    color: '#fff',
  },
  inactiveNavText: {
    textAlign: 'center',
    color: '#0D677D',
  },
  NoDataView: {
    // maxHeight: Dimensions.get('window').height,
    height: 500,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default ResearchScreen;
