import { View, Text, ScrollView, StyleSheet, FlatList } from 'react-native';
import React, { useEffect, useRef, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondarPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import YoutubePlayer from 'react-native-youtube-iframe';
import LessonCard from '../components/cards/LessonCard';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchLessonDetails } from '../api/api';
import HTML from 'react-native-render-html';
import Loader from '../components/Loader';

const LessonDetailsScreen = ({ route }) => {
  const [playing, setPlaying] = useState(false);
  const [lessonDetails, setLessonDetails] = useState(null);
  const [relatedLessons, setRelatedLessons] = useState(null);
  const [loading, setLoading] = useState(true);
  const [videoId, setVideoId] = useState('');
  const scrollViewRef = useRef<ScrollView | null>(null);
  const id = route.params.id;

  const renderLessons = ({ item, index }) => (
    <LessonCard
      id={item.id}
      title={item.heading}
      description={item.lesson_description}
      image={item.lesson_img_path}
      index={index}
      totalCount={relatedLessons.length}
    />
  );

  const getVideoId = (url) => {
    const pattern =
      /(?:youtube\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|[^#]*[?&]v=|[^#]*)|youtu\.be\/)([^"&?/ ]{11})/i;
    const match = url.match(pattern);
    // console.log('match',match)
    setVideoId(match[1]);
    return match ? match[1] : null;
  };

  useEffect(() => {
    if (lessonDetails?.youtube_link) {
      getVideoId(lessonDetails?.youtube_link);
    }
  }, [lessonDetails]);

  useEffect(() => {
    const getLessonDetails = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');
        if (url) {
          const response = await fetchLessonDetails(url, id);
          setLessonDetails(response.lesson);
          setRelatedLessons(response.related_lessons);

          if (scrollViewRef.current) {
            scrollViewRef.current.scrollTo({ y: 0, animated: true });
          }
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching lesson details:', error);
      } finally {
        setLoading(false);
      }
    };

    getLessonDetails();
  }, [id]);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      <SecondarPageHeader title="Lesson Details" borderRadius={0} />
      <View
        style={[
          globalStyles.padHorizontal,
          {
            backgroundColor: '#1D515E',
            borderBottomLeftRadius: 14,
            borderBottomRightRadius: 14,
          },
        ]}>
        <YoutubePlayer
          height={225}
          play={playing}
          videoId={videoId}
          // onChangeState={onStateChange}
        />
      </View>
      <ScrollView style={globalStyles.bgWhite} ref={scrollViewRef}>
        <View style={[globalStyles.padHorizontal, { paddingTop: 15 }]}>
          <View style={{ marginBottom: 15 }}>
            <Text style={[styles.title, globalStyles.mb12]}>
              {lessonDetails?.heading}
            </Text>
            <HTML source={{ html: lessonDetails?.lesson_description }} />
          </View>
          <View style={{ marginBottom: 15 }}>
            <Text style={[styles.title, { marginBottom: 10 }]}>
              Additional Resources
            </Text>
            <View
              style={[styles.blueView, { marginBottom: 20, borderRadius: 5 }]}>
              <HTML source={{ html: lessonDetails?.additional_description }} />
            </View>
          </View>
        </View>
        {relatedLessons && relatedLessons?.length > 0 && (
          <View style={[styles.blueView, globalStyles.padHorizontal]}>
            <Text style={[styles.title, { marginBottom: 10 }]}>
              Related Lessons
            </Text>
            <FlatList
              data={relatedLessons}
              keyExtractor={(item) => item.id}
              renderItem={renderLessons}
            />
          </View>
        )}
      </ScrollView>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  title: {
    fontSize: 18,
    fontWeight: '700',
    color: '#303030',
  },
  subtitle: {
    fontSize: 13,
    fontWeight: '700',
    color: '#303030',
    marginTop: 10,
  },
  description: {
    fontSize: 13,
    color: '#000',
    marginTop: 10,
    lineHeight: 19,
  },
  blueView: {
    backgroundColor: '#F0F5FF',
    // backgroundColor: '#003b49',
    padding: 10,
  },
  blueTitle: {
    color: '#1E8AA5',
    fontSize: 16,
    lineHeight: 18.5,
    fontWeight: '600',
    marginBottom: 10,
  },
  bulletListItem: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  bullet: {
    fontSize: 20,
    marginRight: 10,
    color: '#000',
  },
  blueViewText: {
    color: '#000',
    fontSize: 13,
    fontWeight: '500',
  },
});

export default LessonDetailsScreen;
