import {
  View,
  Text,
  ImageBackground,
  TouchableOpacity,
  StyleSheet,
} from 'react-native';
import React from 'react';
import LinearGradient from 'react-native-linear-gradient';
import { globalStyles } from '../assets/styles/globalStyles';

const BannerCarousel = ({
  item,
}: {
  item: { id: string; heading: string; app_banner_img_path: string };
}) => {
  return (
    <View style={globalStyles.padHorizontal}>
      <View style={styles.imageWrapper}>
        <ImageBackground
          source={{ uri: item.app_banner_img_path }}
          style={{
            flex: 1,
            flexDirection: 'row',
            alignItems: 'flex-end',
            gap: 15,
            paddingBottom: 10,
          }}
          resizeMode="cover">
          <LinearGradient
            colors={['rgba(0, 0, 0, 0.0567)', 'rgba(0, 0, 0, 0.5589)']}
            style={globalStyles.overlay}
            start={{ x: 0.5, y: 0 }}
            end={{ x: 0.5, y: 1 }}
          />
          {/* <View style={styles.flexWrapper}> */}
          <View style={styles.titleWrapper}>
            <Text style={styles.title}>{item.heading}</Text>
          </View>
          {/* <TouchableOpacity style={styles.btnWrapper}> */}
          {/* <Text style={styles.btnTitle}>Read More</Text> */}
          {/* </TouchableOpacity> */}
          {/* </View> */}
        </ImageBackground>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  imageWrapper: {
    borderRadius: 12,
    height: 190,
    width: '100%',
    overflow: 'hidden',
  },
  flexWrapper: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingHorizontal: 15,
    gap: 15,
    justifyContent: 'center',
  },
  titleWrapper: {
    paddingHorizontal: 15,
    // width: '65%',
  },
  title: {
    color: '#fff',
    fontSize: 18,
    fontWeight: '700',
  },
  btnWrapper: {
    borderWidth: 2,
    borderColor: '#fff',
    paddingVertical: 5,
    borderRadius: 8,
    alignSelf: 'flex-end',
    flex: 1,
  },
  btnTitle: {
    color: '#fff',
    textAlign: 'center',
    fontWeight: '600',
  },
});

export default BannerCarousel;
