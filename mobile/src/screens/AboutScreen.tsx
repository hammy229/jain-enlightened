import {
  View,
  Text,
  ScrollView,
  StyleSheet,
  Image,
  Pressable,
  FlatList,
  Dimensions,
  RefreshControl,
} from 'react-native';
import React, { useEffect, useRef, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import { globalStyles } from '../assets/styles/globalStyles';
import LinearGradient from 'react-native-linear-gradient';
import AboutUsCard from '../components/cards/AboutUsCard';
import GoalsCard from '../components/cards/GoalsCard';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { fonts } from '../assets/fonts';
import RightArrowButton from '../components/buttons/RightArrowButton';
import { colors } from '../assets/styles/colors';
import Carousel from 'react-native-reanimated-carousel';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchAboutUsDetails } from '../api/api';
import Loader from '../components/Loader';
import HTML, { RenderHTML } from 'react-native-render-html';
import { handleLink, splitHeading } from '../utils';
import { Easing, ReduceMotion } from 'react-native-reanimated';

const width = Dimensions.get('window').width;

const AboutScreen = () => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [currentIndexTeam, setCurrentIndexTeam] = useState(0);
  const [goalIndex, setGoalIndex] = useState(0);
  const [aboutDetails, setAboutDetails] = useState([]);
  const [advisoryBoard, setAdvisoryBoard] = useState([]);
  const [strategicGoals, setStrategicGoals] = useState([]);
  const [team, setTeam] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);
  const flatListRef = useRef(null);
  const flatListRefTeam = useRef(null);

  const getAboutDetails = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchAboutUsDetails(url);
        setAboutDetails(response?.about_us);
        setAdvisoryBoard(response?.advisory_boards);
        setTeam(response?.our_teams);
        setStrategicGoals(response?.Strategicgoals);
      } else {
        console.log('Base URL not found in AsyncStorage');
      }
    } catch (error) {
      console.log('Error fetching about us details: ', error);
    } finally {
      setLoading(false);
    }
  };

  const onRefresh = async () => {
    setRefreshing(true);
    await getAboutDetails();
    setRefreshing(false);
  };

  useEffect(() => {
    getAboutDetails();
  }, []);

  const onViewRef = useRef(({ changed }) => {
    if (changed && changed.length > 0) {
      const index = changed[0].index;
      setCurrentIndex(index);
    }
  });

  const onViewRefTeam = useRef(({ viewableItems }) => {
    if (viewableItems.length > 0) {
      setCurrentIndexTeam(viewableItems[0].index);
    }
  });

  const viewConfigRef = useRef({ viewAreaCoveragePercentThreshold: 50 });

  const tagsStyles = {
    p: {
      fontFamily: fonts.JakartaRegular,
      fontSize: 18,
      color: colors.black,
      alignText: 'justify',
    },
    span: {
      color: '#000000',
      fontSize: 14.5,
      marginTop: 15,
      lineHeight: 19,
      fontFamily: fonts.JakartaRegular,
      textAlign: 'justify',
    },
  };

  const renderAboutCard = ({ item }) => (
    <AboutUsCard
      position={item?.designation}
      title={item?.name}
      image={item?.team_img_path}
      linkedinUrl={item?.linkedin_url}
      description={item?.description}
    />
  );

  const renderGoalsCard = ({ item }) => <GoalsCard item={item} />;

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* AboutUs Header */}
      <SecondaryPageHeader title="About Us" />

      {/* AboutUs List */}
      <ScrollView
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        showsVerticalScrollIndicator={false}
        style={[{ flex: 1, marginBottom: 20 }]}>
        <Text
          style={[
            globalStyles.sectionTitleBlack,
            globalStyles.padHorizontal,
            globalStyles.padVertical,
          ]}>
          {splitHeading(aboutDetails?.about_heading).mainText}{' '}
          <Text style={globalStyles.sectionTitleBlue}>
            {splitHeading(aboutDetails?.about_heading).highlightedText}
          </Text>
        </Text>
        <View style={globalStyles.padHorizontal}>
          <View style={[styles.cardsStyle, globalStyles.mb12]}>
            <Image
              source={{ uri: aboutDetails?.about_img_1_path }}
              style={{
                height: 160,
                width: '100%',
                objectFit: 'cover',
                borderRadius: 5,
              }}
            />

            <View style={{ paddingVertical: 10 }}>
              <HTML
                source={{ html: aboutDetails?.about_description }}
                tagsStyles={tagsStyles}
              />
            </View>
          </View>
        </View>

        <View style={globalStyles.padHorizontal}>
          <View style={[styles.cardsStyle, globalStyles.mb12]}>
            <View
              style={{
                flexDirection: 'row',
                alignItems: 'center',
                alignSelf: 'flex-start',
                gap: 8,
              }}>
              <Image
                source={require('../assets/images/MissonLogo.png')}
                style={styles.smallLogoStyle}
              />
              <Text style={[globalStyles.sectionTitleBlack]}>
                {splitHeading(aboutDetails?.mission_heading).mainText}{' '}
                <Text style={globalStyles.sectionTitleBlue}>
                  {splitHeading(aboutDetails?.mission_heading).highlightedText}
                </Text>
              </Text>
            </View>
            <Text style={styles.paragraphStyle}>
              {aboutDetails?.mission_description}
            </Text>
          </View>
        </View>

        <View style={[globalStyles.padHorizontal, globalStyles.mb12]}>
          <View style={[styles.cardsStyle, globalStyles.mb12]}>
            <View
              style={{
                flexDirection: 'row',
                alignItems: 'center',
                alignSelf: 'flex-start',
                gap: 8,
              }}>
              <Image
                source={require('../assets/images/MissonLogo.png')}
                style={styles.smallLogoStyle}
              />
              <Text style={[globalStyles.sectionTitleBlack]}>
                {splitHeading(aboutDetails?.vision_heading).mainText}{' '}
                <Text style={globalStyles.sectionTitleBlue}>
                  {splitHeading(aboutDetails?.vision_heading).highlightedText}
                </Text>
              </Text>
            </View>
            <Text style={styles.paragraphStyle}>
              {aboutDetails?.vision_description}
            </Text>
          </View>
        </View>

        <View style={globalStyles.padHorizontal}>
          <View style={globalStyles.mb12}>
            <Text style={[globalStyles.sectionTitleBlack]}>
              {splitHeading(aboutDetails?.journey_heading).mainText}{' '}
              <Text style={globalStyles.sectionTitleBlue}>
                {splitHeading(aboutDetails?.journey_heading).highlightedText}
              </Text>
            </Text>
          </View>
          <Image
            source={{ uri: aboutDetails?.journey_img_path }}
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

          <View
            style={[
              globalStyles.mb12,
              {
                flexDirection: 'row',
                alignItems: 'center',
                justifyContent: 'space-between',
              },
            ]}>
            <Text style={[globalStyles.sectionTitleBlack, { fontSize: 16 }]}>
              Founder -{' '}
              <Text style={[globalStyles.sectionTitleBlue, { fontSize: 16 }]}>
                Arham Doshi
              </Text>
            </Text>
            <Pressable
              onPress={() => {
                handleLink(aboutDetails?.linkedin_url);
              }}>
              <Image
                source={require('../assets/images/LinkedInBtn.png')}
                style={{ height: 28, width: 90 }}
                resizeMode="cover"
              />
            </Pressable>
          </View>
          <View style={styles.borderStyle} />
          <HTML source={{ html: aboutDetails?.journey_description }} />
          {/* <View style={{ marginBottom: 24 }}>
            <RightArrowButton
              title="Read More"
              color={colors.blue}
              route="FounderMessage"
            />
          </View> */}
        </View>

        <LinearGradient
          colors={['#E7F3F1', '#F0FFFD']}
          start={{ x: 0.5, y: 0.5 }}
          end={{ x: 0.5, y: 1 }}
          style={{ marginVertical: 10, paddingVertical: 20 }}>
          <View style={globalStyles.padHorizontal}>
            <Text style={[globalStyles.sectionTitleBlack, globalStyles.mb12]}>
              {splitHeading(aboutDetails?.guidance_heading).mainText}{' '}
              <Text style={globalStyles.sectionTitleBlue}>
                {splitHeading(aboutDetails?.guidance_heading).highlightedText}
              </Text>
            </Text>
            <Image
              source={{ uri: aboutDetails?.guidance_img_path }}
              style={[
                globalStyles.mb12,
                {
                  width: '100%',
                  height: 200,
                  objectFit: 'cover',
                  borderRadius: 10,
                },
              ]}
              resizeMode="cover"
            />
            <View style={globalStyles.mb12}>
              <HTML
                source={{ html: aboutDetails?.guidance_short_description }}
              />
            </View>

            <RightArrowButton
              title="Read More"
              color={colors.blue}
              route="Guidance"
              pageDetails={aboutDetails}
            />
          </View>
        </LinearGradient>

        <View style={[globalStyles.padHorizontal, globalStyles.mb12]}>
          <View style={[styles.cardsStyle, globalStyles.mb12]}>
            <Text style={[globalStyles.sectionTitleBlack, globalStyles.mb12]}>
              {splitHeading(aboutDetails?.acknow_heading).mainText}{' '}
              <Text style={globalStyles.sectionTitleBlue}>
                {splitHeading(aboutDetails?.acknow_heading).highlightedText}
              </Text>
            </Text>
            <View style={globalStyles.mb12}>
              <HTML source={{ html: aboutDetails?.acknow_short_description }} />
            </View>
            <RightArrowButton
              title="Read More"
              color={colors.blue}
              pageDetails={aboutDetails}
              route="Acknowledgement"
            />
          </View>
        </View>
        {advisoryBoard?.length > 0 && (
          <>
            <View style={[globalStyles.padHorizontal, { marginVertical: 10 }]}>
              <Text style={[globalStyles.sectionTitleBlack]}>
                Advisory{' '}
                <Text style={globalStyles.sectionTitleBlue}>Board</Text>
              </Text>
            </View>
            <View style={[styles.horizontalScrollPad]}>
              <FlatList
                data={advisoryBoard}
                horizontal
                showsHorizontalScrollIndicator={false}
                renderItem={renderAboutCard}
                onScrollToIndexFailed={() => {}}
                onViewableItemsChanged={onViewRef.current}
                viewabilityConfig={viewConfigRef.current}
                ref={flatListRef}
                scrollEventThrottle={16}
              />
              <View style={styles.pagination}>
                {advisoryBoard?.length > 1 &&
                  advisoryBoard.map((_, index) => (
                    <View
                      key={index}
                      style={[
                        styles.dot,
                        globalStyles.mb12,
                        {
                          backgroundColor:
                            index === currentIndex ? '#1E8AA5' : '#C0C0C0',
                        },
                      ]}
                    />
                  ))}
              </View>
            </View>
          </>
        )}
        {team?.length > 0 && (
          <>
            <View style={[globalStyles.padHorizontal, { marginVertical: 10 }]}>
              <Text style={[globalStyles.sectionTitleBlack]}>
                Meet Our{' '}
                <Text style={globalStyles.sectionTitleBlue}>Team!</Text>
              </Text>
            </View>
            <View style={[styles.horizontalScrollPad]}>
              <FlatList
                data={team}
                horizontal
                showsHorizontalScrollIndicator={false}
                renderItem={renderAboutCard}
                onScrollToIndexFailed={() => {}}
                onViewableItemsChanged={onViewRefTeam.current}
                viewabilityConfig={viewConfigRef.current}
                ref={flatListRefTeam}
                scrollEventThrottle={16}
              />
              <View style={styles.pagination}>
                {team?.length > 1 &&
                  team.map((_, index) => (
                    <View
                      key={index}
                      style={[
                        styles.dot,
                        globalStyles.mb12,
                        {
                          backgroundColor:
                            index === currentIndexTeam ? '#1E8AA5' : '#C0C0C0',
                        },
                      ]}
                    />
                  ))}
              </View>
            </View>
          </>
        )}

        {strategicGoals?.length > 0 && (
          <>
            <View style={[globalStyles.padHorizontal, { marginVertical: 10 }]}>
              <Text style={globalStyles.sectionTitleBlue}>
                {aboutDetails?.strategic_heading}
              </Text>
            </View>
            <Carousel
              loop
              width={width}
              height={265}
              autoPlay={false}
              data={strategicGoals}
              renderItem={renderGoalsCard}
              withAnimation={{
                type: 'timing',
                config: {
                  duration: 1000,
                  easing: Easing.out(Easing.exp),
                  reduceMotion: ReduceMotion.Never,
                },
              }}
              onSnapToItem={(index) => setGoalIndex(index)}
            />
            <View style={[styles.pagination, globalStyles.mb12]}>
              {strategicGoals.map((_, index) => (
                <View
                  key={index}
                  style={[
                    styles.dot,
                    globalStyles.mb12,
                    {
                      backgroundColor:
                        index === goalIndex ? '#1E8AA5' : '#C0C0C0',
                    },
                  ]}
                />
              ))}
            </View>
          </>
        )}
      </ScrollView>
    </LayoutWrapper>
  );
};

export default AboutScreen;

const styles = StyleSheet.create({
  HeaderText: {
    fontSize: 21,
    color: '#000',
    fontFamily: fonts.JakartaSemiBold,
    lineHeight: 27,
  },
  borderStyle: {
    marginVertical: 10,
    borderColor: '#D9D9D9',
    borderWidth: 0.6,
    height: 0,
  },
  spanstyle: {
    color: '#167E98',
    fontFamily: fonts.JakartaExtraBold,
    lineHeight: 27,
  },
  cardsStyle: {
    padding: 15,
    backgroundColor: '#fff',
    borderRadius: 5,
    shadowColor: '#000000',
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 0.12,
    shadowRadius: 15.7,
    elevation: 1,
  },
  imageStyle: {
    height: 180,
    width: 360,
    borderRadius: 5,
  },
  smallLogoStyle: {
    height: 28,
    width: 28,
  },
  journeyimgStyle: {
    height: 200,
    width: 393,
    borderRadius: 5,
  },
  paragraphStyle: {
    color: '#000000',
    fontSize: 14,
    marginTop: 15,
    lineHeight: 19,
    fontFamily: fonts.JakartaRegular,
    textAlign: 'justify',
  },
  horizontalScrollPad: {
    paddingLeft: 15,
  },
  dot: {
    height: 5,
    width: 16,
    borderRadius: 4,
    marginHorizontal: 4,
  },
  pagination: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginTop: 10,
  },
  readmoretext: {
    color: '#167E98',
    fontSize: 14,
    fontFamily: fonts.OpenSansSemiBold,
  },
});
