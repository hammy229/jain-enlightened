import {
  View,
  Text,
  ScrollView,
  StyleSheet,
  Image,
  FlatList,
  Dimensions,
  RefreshControl,
  Animated,
} from 'react-native';
import React, { useEffect, useRef, useState } from 'react';
import HomeHeader from '../components/HomeHeader';
import { LeftArrowBlue, RightArrowBlue, Target } from '../assets/images';
import AnnouncementSlider from '../components/AnnouncementSlider';
import LayoutWrapper from '../layouts/LayoutWrapper';
import LessonCardHome from '../components/cards/LessonCardHome';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import RightArrowButton from '../components/buttons/RightArrowButton';
import { colors } from '../assets/styles/colors';
import PodcastCard from '../components/cards/PodcastCard';
import Carousel from 'react-native-reanimated-carousel';
import AdditionalResourceCard from '../components/cards/AdditionalResourceCard';
import AcademicResourceCard from '../components/cards/AcademicResourceCard';
import BlogCard from '../components/cards/BlogCard';
import TestimonialCard from '../components/cards/TestimonialCard';
import LinearGradient from 'react-native-linear-gradient';
import OpportunityCard from '../components/cards/OpportunityCard';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchHomeDetails } from '../api/api';
import Loader from '../components/Loader';
import { splitHeading } from '../utils';
import HTML from 'react-native-render-html';
import { Easing, ReduceMotion } from 'react-native-reanimated';
import { TouchableOpacity } from 'react-native-gesture-handler';
import type { ICarouselInstance } from 'react-native-reanimated-carousel';
import MyModalWithIframe from '../components/modal/ChatBotModal';
import ChatbotButtonModal from '../components/modal/ChatBotModal';

const HomeScreen = () => {
  const [refreshing, setRefreshing] = useState(false);
  const [announcementIndex, setAnnouncementIndex] = useState(0);
  const [podcastIndex, setPodcastIndex] = useState(0);
  const [additionalResourceIndex, setAdditionalResourceIndex] = useState(0);
  const [academicResourceIndex, setAcademicResourceIndex] = useState(0);
  const [testimonialIndex, setTestimonialIndex] = useState(0);
  const [loading, setLoading] = useState(true);
  const [banners, setBanners] = useState([]);
  const [announcements, setAnnouncements] = useState([]);
  const [headings, setHeadings] = useState();
  const [lessons, setLessons] = useState([]);
  const [mission, setMission] = useState();
  const [podcasts, setPodcasts] = useState([]);
  const [foundersMessage, setFoundersMessage] = useState();
  const [educationalResearch, setEducationalResearch] = useState([]);
  const [academicResearch, setAcademicResearch] = useState([]);
  const [blogs, setBlogs] = useState([]);
  const [gallery, setGallery] = useState([]);
  const [testimonials, setTestimonials] = useState([]);
  const [testimonialLimit, setTestimonialLimit] = useState(false);
  const [internshipDetails, setInternshipDetails] = useState();
  const width = Dimensions.get('window').width;
  const testimonialRef = React.useRef<ICarouselInstance>(null);
  const academicFlatlistRef = useRef(null);
  const heightAnim = useRef(new Animated.Value(280)).current;

  const announcementData = [
    {
      id: Object.keys(announcements).length === 0 && '1',
      title: announcements?.card_heading_1,
      description: announcements?.card_description_1,
      image: announcements?.card_icon_1_path,
    },
    {
      id: Object.keys(announcements).length === 0 && '2',
      title: announcements?.card_heading_2,
      description: announcements?.card_description_2,
      image: announcements?.card_icon_2_path,
    },
    {
      id: Object.keys(announcements).length === 0 && '3',
      title: announcements?.card_heading_3,
      description: announcements?.card_description_3,
      image: announcements?.card_icon_3_path,
    },
  ];

  const getHomeDetails = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchHomeDetails(url);
        setBanners(response?.banners);
        setAnnouncements(response?.announcement_cards);
        setHeadings(response?.headings);
        setLessons(response?.lessons);
        setMission(response?.mission);
        setPodcasts(response?.podcasts);
        setFoundersMessage(response?.founder_message);
        setEducationalResearch(response?.educational_researches);
        setAcademicResearch(response?.academic_researches);
        setBlogs(response?.blogs);
        setTestimonials(response?.testimonials);
        setGallery(response?.galleries);
        setInternshipDetails(response?.internship);
      } else {
        console.log('Base URL not found in AsyncStorage');
      }
    } catch (error) {
      console.log('Error fetching base URL or blogs: ', error);
    } finally {
      setLoading(false);
    }
  };

  const onViewRef = useRef(({ viewableItems }) => {
    if (viewableItems.length > 0) {
      setAcademicResourceIndex(viewableItems[0].index);
    }
  });

  const viewConfigRef = useRef({ viewAreaCoveragePercentThreshold: 50 });

  useEffect(() => {
    getHomeDetails();
  }, []);

  // useEffect(() => {
  //   // Check the word limit of the current testimonial description
  //   const currentTestimonial = testimonials[testimonialIndex];
  //   if (currentTestimonial) {
  //     const wordCount = currentTestimonial.description.split(' ').length;
  //     setTestimonialLimit(wordCount > 10);
  //   }
  // }, [testimonialIndex, testimonials]);

  useEffect(() => {
    // Check the word limit of the current testimonial description
    const currentTestimonial = testimonials[testimonialIndex];
    if (currentTestimonial) {
      const wordCount = currentTestimonial.description.split(' ').length;
      const newLimit = wordCount > 10;

      // Only animate if there's a change
      if (newLimit !== testimonialLimit) {
        setTestimonialLimit(newLimit);
        Animated.timing(heightAnim, {
          toValue: !newLimit ? 215 : 280,
          duration: 100, // Adjust the duration as needed
          easing: Easing.out(Easing.exp),
          useNativeDriver: false, // Disable if height animation is not supported
        }).start();
      }
    }
  }, [testimonialIndex, testimonials]);

  const handleViewableItemsChanged = useRef(({ viewableItems }) => {
    if (viewableItems.length > 0) {
      const currentIndex = viewableItems[0].index;
      if (
        currentIndex !== undefined &&
        currentIndex !== academicResourceIndex
      ) {
        setAcademicResourceIndex(currentIndex);
      }
    }
  }).current;

  const onRefresh = async () => {
    setRefreshing(true);
    await getHomeDetails();
    setRefreshing(false);
  };

  if (loading) {
    return <Loader />;
  }

  const renderLessonCard = ({ item }) => (
    <LessonCardHome
      id={item.id}
      image={item.lesson_img_path}
      title={item.heading}
    />
  );

  const renderAnnouncementSlider = ({ item }) => (
    <AnnouncementSlider item={item} />
  );

  const renderPodcast = ({ item }) => (
    <PodcastCard
      title={item.heading}
      image={item.podcast_img_path}
      ytLink={item.youtube_url}
    />
  );

  const renderAdditionalResource = ({ item }) => (
    <AdditionalResourceCard
      title={item.heading}
      image={item.research_img_path}
      description={item.description}
      link={item.research_url}
    />
  );

  const renderAcademicResource = ({ item }) => (
    <AcademicResourceCard
      title={item.heading}
      image={item.research_img_path}
      description={item.description}
      link={item.research_url}
    />
  );

  const renderBlogCard = ({ item }) => (
    <BlogCard
      id={item.id}
      title={item.heading}
      author={item.blog_by}
      description={item.short_description}
      image={item.blog_img_path}
    />
  );

  const renderTestimonials = ({ item }) => {
    return (
      <TestimonialCard
        name={item.name}
        location={item.location}
        profileImage={item.teastimonial_img_path}
        testimonial={item.description}
      />
    );
  };

  return (
    <LayoutWrapper>
      <ScrollView
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        nestedScrollEnabled
        style={styles.container}>
        {/* Header Section */}
        <HomeHeader banners={banners} />
        {/* Announcement Section */}
        <View style={styles.padHorizontal}>
          <Carousel
            loop
            width={width}
            height={125}
            autoPlay={false}
            data={announcementData}
            renderItem={renderAnnouncementSlider}
            onSnapToItem={(index) => setAnnouncementIndex(index)}
            scrollAnimationDuration={1000}
            withAnimation={{
              type: 'timing',
              config: {
                duration: 250,
                easing: Easing.out(Easing.exp),
                reduceMotion: ReduceMotion.Never,
              },
            }}
            onSnapToItem={(index) => setAnnouncementIndex(index)}
          />
          <View style={styles.pagination}>
            {announcementData?.map((_, index) => (
              <View
                key={index}
                style={[
                  styles.dot,
                  {
                    backgroundColor:
                      index === announcementIndex ? '#1E8AA5' : '#C0C0C0',
                  },
                ]}
              />
            ))}
          </View>
        </View>

        {/* Explore Lessons Section */}
        {lessons.length > 0 ? (
          <View>
            <View style={[styles.padHorizontal, styles.marginVertical]}>
              <View style={styles.sectionTitleContainer}>
                <Text style={globalStyles.sectionTitleBlack}>
                  {splitHeading(headings?.lessons_heading).mainText}{' '}
                  <Text style={globalStyles.sectionTitleBlue}>
                    {splitHeading(headings?.lessons_heading).highlightedText}
                  </Text>
                </Text>
                <RightArrowButton
                  title="View all"
                  color={colors.black}
                  route="LessonStack"
                />
              </View>
            </View>
            <View style={[styles.horizontalScrollPad]}>
              <FlatList
                // data={lessons}
                data={lessons.slice(0, 6)}
                horizontal
                showsHorizontalScrollIndicator={false}
                renderItem={renderLessonCard}
                keyExtractor={(item) => item.id}
              />
            </View>
          </View>
        ) : null}

        {/* Mission Section */}
        {mission == null || mission == undefined ? null : (
          <View style={[globalStyles.padHorizontal, globalStyles.padVertical]}>
            <View
              style={[
                { flexDirection: 'row', gap: 12, alignItems: 'center' },
                globalStyles.mb12,
              ]}>
              <Image
                source={Target}
                style={{ height: 45, width: 45, objectFit: 'contain' }}
              />
              <View>
                <Text style={globalStyles.sectionTitleBlack}>
                  {splitHeading(mission?.about_heading).mainText}
                </Text>
                <Text style={globalStyles.sectionTitleBlue}>
                  {splitHeading(mission?.about_heading).highlightedText}
                </Text>
              </View>
            </View>
            <Image
              source={{ uri: mission?.about_image_path }}
              style={[
                globalStyles.mb12,
                {
                  width: '100%',
                  height: 200,
                  objectFit: 'cover',
                  borderRadius: 10,
                },
              ]}
            />
            {/* <HTML source={{ html: mission?.about_description }} /> */}
            <Text style={[styles.regularText, globalStyles.mb12]}>
              {mission?.short_description}
            </Text>
            <RightArrowButton
              title="Read more"
              color={colors.blue}
              route="Mission"
              pageDetails={mission}
              pageName="Mission"
            />
          </View>
        )}

        {/* Founders Message */}
        {foundersMessage == null || foundersMessage == undefined ? null : (
          <View style={[globalStyles.padHorizontal]}>
            <View style={globalStyles.mb12}>
              <Text style={globalStyles.sectionTitleBlack}>
                {splitHeading(headings.founders_heading).mainText}{' '}
                <Text style={globalStyles.sectionTitleBlue}>
                  {splitHeading(headings.founders_heading).highlightedText}
                </Text>
              </Text>
            </View>

            <Image
              source={{ uri: foundersMessage?.founders_image_path }}
              style={[
                globalStyles.mb12,
                {
                  width: '100%',
                  // height: 320,
                  height: 200,
                  objectFit: 'cover',
                  borderRadius: 10,
                },
              ]}
            />
            <Text style={[styles.regularText, globalStyles.mb12]}>
              {foundersMessage?.founders_short_description}
            </Text>
            <RightArrowButton
              title="Read more"
              color={colors.blue}
              route="FounderMessage"
              data={foundersMessage}
            />
          </View>
        )}

        {/* Explore Podcast Section */}
        {podcasts.length > 0 ? (
          <View style={globalStyles.padVertical}>
            <View
              style={[globalStyles.padHorizontal, globalStyles.padVertical]}>
              <View style={styles.sectionTitleContainer}>
                <Text style={globalStyles.sectionTitleBlack}>
                  {splitHeading(headings?.podcasts_heading).mainText}{' '}
                  <Text style={globalStyles.sectionTitleBlue}>
                    {splitHeading(headings?.podcasts_heading).highlightedText}
                  </Text>
                </Text>
                <RightArrowButton
                  title="View all"
                  color={colors.black}
                  route="Podcast"
                />
              </View>
            </View>

            <View style={{ position: 'relative' }}>
              <Carousel
                loop
                width={width}
                height={265}
                autoPlay={false}
                data={podcasts.slice(0, 3)}
                renderItem={renderPodcast}
                withAnimation={{
                  type: 'timing',
                  config: {
                    duration: 250,
                    easing: Easing.out(Easing.exp),
                    reduceMotion: ReduceMotion.Never,
                  },
                }}
                onSnapToItem={(index) => setPodcastIndex(index)}
              />
              <View
                style={[
                  styles.pagination,
                  { position: 'absolute', right: 35, bottom: 30 },
                ]}>
                {podcasts.slice(0, 3).map((_, index) => (
                  <View
                    key={index}
                    style={[
                      styles.dot,
                      {
                        backgroundColor:
                          index === podcastIndex ? '#1E8AA5' : '#C0C0C0',
                      },
                    ]}
                  />
                ))}
              </View>
            </View>
          </View>
        ) : null}

        {/* Educational Resources */}
        {educationalResearch.length > 0 ? (
          <View>
            <View style={[globalStyles.padHorizontal]}>
              <View
                style={[
                  styles.sectionTitleContainer,
                  globalStyles.mb12,
                  { alignItems: 'flex-end' },
                ]}>
                <View style={{ width: '80%' }}>
                  <Text style={globalStyles.sectionTitleBlack}>
                    {splitHeading(headings?.jain_edu_heading).mainText}{' '}
                    <Text style={globalStyles.sectionTitleBlue}>
                      {splitHeading(headings?.jain_edu_heading).highlightedText}
                    </Text>
                  </Text>
                </View>
                <View style={{ marginBottom: 2 }}>
                  <RightArrowButton
                    title="View all"
                    color={colors.black}
                    route="Research"
                    section="Educational Resources"
                  />
                </View>
              </View>
            </View>
            <View style={[globalStyles.mb12, { position: 'relative' }]}>
              <Carousel
                loop={educationalResearch.length > 1 && true}
                width={width}
                height={265}
                autoPlay={false}
                data={educationalResearch.slice(0, 3)}
                renderItem={renderAdditionalResource}
                withAnimation={{
                  type: 'timing',
                  config: {
                    duration: 1000,
                    easing: Easing.out(Easing.exp),
                    reduceMotion: ReduceMotion.Never,
                  },
                }}
                onSnapToItem={(index) => setAdditionalResourceIndex(index)}
              />
              <View
                style={[
                  styles.pagination,
                  { position: 'absolute', left: 35, bottom: 35 },
                ]}>
                {educationalResearch.length > 1 &&
                  educationalResearch.slice(0, 3).map((_, index) => (
                    <View
                      key={index}
                      style={[
                        styles.dot,
                        {
                          backgroundColor:
                            index === additionalResourceIndex
                              ? '#1E8AA5'
                              : '#C0C0C0',
                        },
                      ]}
                    />
                  ))}
              </View>
            </View>
          </View>
        ) : null}

        {/* Academic Resources */}
        {academicResearch.length > 0 ? (
          <View style={globalStyles.mb12}>
            <View style={[styles.padHorizontal, styles.marginVertical]}>
              <View
                style={[
                  styles.sectionTitleContainer,
                  { alignItems: 'flex-end' },
                ]}>
                <Text
                  style={[globalStyles.sectionTitleBlack, { width: '80%' }]}>
                  {splitHeading(headings?.jain_acd_heading).mainText}{' '}
                  <Text style={globalStyles.sectionTitleBlue}>
                    {splitHeading(headings?.jain_acd_heading).highlightedText}
                  </Text>
                </Text>
                <View style={{ marginBottom: 2 }}>
                  <RightArrowButton
                    title="View all"
                    color={colors.black}
                    route="Research"
                    section="Academic Resources"
                  />
                </View>
              </View>
            </View>
            <View style={styles.horizontalScrollPad}>
              <FlatList
                data={academicResearch.slice(0, 3)}
                ref={academicFlatlistRef}
                horizontal
                showsHorizontalScrollIndicator={false}
                renderItem={renderAcademicResource}
                keyExtractor={(item) => item.id}
                onViewableItemsChanged={onViewRef.current}
                viewabilityConfig={viewConfigRef.current}
              />
              <View style={[styles.pagination, globalStyles.mb12]}>
                {academicResearch?.length > 1 &&
                  academicResearch.slice(0, 3).map((_, index) => (
                    <View
                      key={index}
                      style={[
                        styles.dot,
                        {
                          backgroundColor:
                            index === academicResourceIndex
                              ? '#1E8AA5'
                              : '#C0C0C0',
                        },
                      ]}
                    />
                  ))}
              </View>
            </View>
          </View>
        ) : null}

        {/* Latest Blogs */}
        {blogs.length > 0 ? (
          <>
            <View style={[globalStyles.padHorizontal, globalStyles.mb12]}>
              <View
                style={[
                  styles.sectionTitleContainer,
                  globalStyles.mb12,
                  { alignItems: 'flex-end' },
                ]}>
                <View>
                  <Text style={globalStyles.sectionTitleBlack}>
                    {splitHeading(headings?.blog_heading).mainText}{' '}
                    <Text style={globalStyles.sectionTitleBlue}>
                      {splitHeading(headings?.blog_heading).highlightedText}
                    </Text>
                  </Text>
                </View>
                <View style={{ marginBottom: 2 }}>
                  <RightArrowButton
                    title="View all"
                    color={colors.black}
                    route="BlogStack"
                  />
                </View>
              </View>
            </View>
            <Carousel
              loop={blogs?.length > 1 && true}
              width={width}
              height={365}
              autoPlay={false}
              data={blogs.slice(0, 3)}
              withAnimation={{
                type: 'timing',
                config: {
                  duration: 1000,
                  easing: Easing.out(Easing.exp),
                  reduceMotion: ReduceMotion.Never,
                },
              }}
              renderItem={renderBlogCard}
            />
          </>
        ) : null}

        {/* Our Gallery */}
        {gallery?.length >= 4 && (
          <View style={[globalStyles.padHorizontal, globalStyles.mb12]}>
            <View
              style={[
                styles.sectionTitleContainer,
                globalStyles.mb12,
                { alignItems: 'flex-end' },
              ]}>
              <View>
                <Text style={globalStyles.sectionTitleBlack}>
                  {splitHeading(headings?.gallery_heading).mainText}{' '}
                  <Text style={globalStyles.sectionTitleBlue}>
                    {splitHeading(headings?.gallery_heading).highlightedText}
                  </Text>
                </Text>
              </View>
              <View style={{ marginBottom: 2 }}>
                <RightArrowButton
                  title="View all"
                  color={colors.black}
                  route="Gallery"
                />
              </View>
            </View>
            <View
              style={[
                styles.galleryContainer,
                globalStyles.mb12,
                { width: '98%' },
              ]}>
              <View style={{ gap: 10, width: '45%' }}>
                <Image
                  source={{ uri: gallery[0].gallery_img_path }}
                  style={styles.galleryImage1}
                />
                <Image
                  source={{ uri: gallery[1].gallery_img_path }}
                  style={styles.galleryImage2}
                />
              </View>
              <View style={{ gap: 10, width: '55%' }}>
                <Image
                  source={{ uri: gallery[2].gallery_img_path }}
                  style={styles.galleryImage2}
                />
                <Image
                  source={{ uri: gallery[3].gallery_img_path }}
                  style={styles.galleryImage1}
                />
              </View>
            </View>
          </View>
        )}

        {/* Testimonials */}

        {testimonials.length > 0 ? (
          <LinearGradient
            colors={['#FFFFFF', '#E7F3F1']}
            start={{ x: 0, y: 0 }}
            end={{ x: 0, y: 1 }}
            style={{ flex: 1 }}>
            <View style={[globalStyles.padHorizontal]}>
              <View
                style={[
                  styles.sectionTitleContainer,
                  globalStyles.mb12,
                  { alignItems: 'flex-end' },
                ]}>
                <Text style={globalStyles.sectionTitleBlack}>
                  {splitHeading(headings?.testimonials_heading).mainText}{' '}
                  <Text style={globalStyles.sectionTitleBlue}>
                    {
                      splitHeading(headings?.testimonials_heading)
                        .highlightedText
                    }
                  </Text>
                </Text>
              </View>
            </View>
            <View style={[styles.buttonParent, globalStyles.mb12]}>
              {/* <Carousel
                ref={testimonialRef}
                loop
                width={width}
                height={!testimonialLimit ? 215 : 280}
                autoPlay={false}
                data={testimonials}
                renderItem={renderTestimonials}
                withAnimation={{
                  type: 'timing',
                  config: {
                    duration: 1000,
                    easing: Easing.out(Easing.exp),
                    reduceMotion: ReduceMotion.Never,
                  },
                }}
                onSnapToItem={(index) => setTestimonialIndex(index)}
              /> */}

              <Animated.View style={{ height: heightAnim }}>
                <Carousel
                  ref={testimonialRef}
                  loop
                  width={width}
                  height={heightAnim} // Set height from animated value
                  autoPlay={false}
                  data={testimonials}
                  renderItem={renderTestimonials}
                  withAnimation={{
                    type: 'timing',
                    config: {
                      duration: 1000,
                      easing: Easing.out(Easing.exp),
                      reduceMotion: 'never',
                    },
                  }}
                  onSnapToItem={(index) => setTestimonialIndex(index)} // Update index on slide change
                />
              </Animated.View>
              <View
                style={[styles.buttonContainer, globalStyles.padHorizontal]}>
                <TouchableOpacity
                  onPress={() => testimonialRef.current?.prev()}
                  style={[styles.button, styles.prevBtn]}
                  disabled={testimonialIndex === 0}>
                  <Image
                    source={LeftArrowBlue}
                    style={{ height: 12, width: 12, objectFit: 'contain' }}
                  />
                </TouchableOpacity>
                <TouchableOpacity
                  onPress={() => testimonialRef.current?.next()}
                  style={[styles.button, styles.nextBtn]}
                  disabled={testimonialIndex === testimonials.length - 1}>
                  <Image
                    source={RightArrowBlue}
                    style={{ height: 12, width: 12, objectFit: 'contain' }}
                  />
                </TouchableOpacity>
              </View>
              <View style={globalStyles.mb12}></View>
            </View>
            {/* <View style={[styles.pagination, globalStyles.padVertical]}>
              {testimonials.length > 1 &&
                testimonials.map((_, index) => (
                  <View
                    key={index}
                    style={[
                      styles.dot,
                      {
                        backgroundColor:
                          index === testimonialIndex ? '#1E8AA5' : '#C0C0C0',
                      },
                    ]}
                  />
                ))}
            </View> */}
          </LinearGradient>
        ) : null}
        <View style={[globalStyles.padHorizontal]}>
          <OpportunityCard internshipDetails={internshipDetails} />
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  container: {
    backgroundColor: '#fff',
  },
  sectionTitleContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  pagination: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginTop: 10,
  },
  dot: {
    height: 5,
    width: 16,
    borderRadius: 4,
    marginHorizontal: 4,
  },
  padHorizontal: {
    paddingHorizontal: 20,
  },
  marginVertical: {
    marginVertical: 20,
  },
  horizontalScrollPad: {
    paddingLeft: 15,
  },
  regularText: {
    fontFamily: fonts.JakartaRegular,
    fontSize: 13,
    color: '#000',
    lineHeight: 18,
  },
  galleryContainer: {
    flexDirection: 'row',
    gap: 10,
    height: 400,
    width: '100%',
    flex: 1,
  },
  galleryImage1: {
    height: '65%',
    width: '100%',
    objectFit: 'cover',
    borderRadius: 10,
  },
  galleryImage2: {
    height: '33%',
    width: '100%',
    objectFit: 'cover',
    borderRadius: 10,
  },
  NoDataView: {
    backgroundColor: '#FFF',
    borderColor: '#0D677DE3',
    borderWidth: 1,
    marginHorizontal: 15,
    borderRadius: 8,
    paddingVertical: 15,
  },
  buttonParent: {
    position: 'relative',
    flex: 1,
  },
  buttonContainer: {
    width: '100%',
    flex: 1,
    flexDirection: 'row',
    justifyContent: 'space-between',
    // marginVertical: 20,
    position: 'absolute',
    top: 115,
  },
  button: {
    padding: 5,
    backgroundColor: '#E8EFF1',
    paddingVertical: 15,
  },
  prevBtn: {
    borderTopRightRadius: 5,
    borderBottomEndRadius: 5,
  },
  nextBtn: {
    borderTopLeftRadius: 5,
    borderBottomStartRadius: 5,
  },
  buttonText: {
    color: 'white',
    fontSize: 16,
  },
});

export default HomeScreen;
