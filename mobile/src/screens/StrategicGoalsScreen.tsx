import { View, Text, Image, ScrollView, StyleSheet } from 'react-native';
import React, { useRef } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import { RouteProp } from '@react-navigation/native';
import HTML from 'react-native-render-html';

type StrategicGoalsRouteProp = RouteProp<'StrategicGoals'>;

interface StrategicGoalsProps {
  route: StrategicGoalsRouteProp;
}

const BlogDetailsScreen: React.FC<StrategicGoalsProps> = ({ route }) => {
  const item = route.params.item;
  const scrollViewRef = useRef<ScrollView | null>(null);

  return (
    <LayoutWrapper>
      {/* Strategic Goal Header */}
      <SecondaryPageHeader title="Strategic Goals" borderRadius={0} />

      {/* Strategic Goal Image */}
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
          source={{ uri: item?.strategic_img_path }}
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
          <Text style={styles.title}>{item?.heading}</Text>
          <View
            style={{
              flexDirection: 'row',
              alignItems: 'center',
              justifyContent: 'space-between',
              paddingBottom: 20,
              marginBottom: 20,
              borderBottomColor: '#D9D9D9',
              borderBottomWidth: 1,
            }}
          />
          <HTML source={{ html: item?.description }} contentWidth={1000} />
        </View>
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
