import { View, Text, Image, Pressable, StyleSheet } from 'react-native';
import React from 'react';
import { globalStyles } from '../../assets/styles/globalStyles';
import { RightArrowBlue, User } from '../../assets/images';
import { fonts } from '../../assets/fonts';
import { useNavigation } from '@react-navigation/native';
import RightArrowButton from '../buttons/RightArrowButton';
import { colors } from '../../assets/styles/colors';

interface BlogCardProps {
  id: number;
  title: string;
  author: string;
  description: string;
  image: string;
}

const BlogCard: React.FC<BlogCardProps> = ({
  id,
  title,
  author,
  description,
  image,
}) => {
  const navigation = useNavigation();
  return (
    <Pressable
      style={[globalStyles.padHorizontal, { borderRadius: 10 }]}
      // onPress={() =>
      //   navigation.navigate('BlogDetails', {
      //     id: id,
      //   })
      // }
      onPress={() =>
        navigation.navigate('BlogStack', {
          screen: 'BlogDetails',
          params: { id: id },
        })
      }>
      <View
        style={[
          styles.container,
          globalStyles.cardShadow,
          { borderRadius: 10 },
        ]}>
        <Image source={{ uri: image }} style={styles.image} />
        <View style={(globalStyles.padHorizontal, { padding: 10 })}>
          <Text style={styles.title} numberOfLines={1} ellipsizeMode="tail">
            {title}
          </Text>
          <View
            style={{
              marginTop: 5,
              flexDirection: 'row',
              alignItems: 'center',
              gap: 5,
            }}>
            <Image
              source={User}
              style={{
                height: 16,
                width: 16,
                objectFit: 'contain',
              }}
            />
            <Text
              style={{ fontFamily: fonts.OpenSansSemiBold, fontSize: 12 }}
              numberOfLines={1}
              ellipsizeMode="tail">
              By - {author}
            </Text>
          </View>
          <Text
            style={styles.description}
            numberOfLines={3}
            ellipsizeMode="tail">
            {description}
          </Text>
          <View style={{ marginTop: 10 }}>
            <View style={globalStyles.rightArrowBtn}>
              <Text
                style={[
                  globalStyles.rightArrowBtnTextBlack,
                  { color: colors.blue },
                ]}>
                Read More
              </Text>
              <Image
                source={RightArrowBlue}
                style={globalStyles.rightArrowBtnArrow}
              />
            </View>
          </View>
        </View>
      </View>
    </Pressable>
  );
};

const styles = StyleSheet.create({
  container: {
    width: '100%',
    borderRadius: 10,
    // overflow: 'hidden',
    backgroundColor: '#fff',
    marginBottom: 20,
  },
  image: {
    height: 180,
    width: '100%',
    position: 'relative',
    justifyContent: 'center',
    alignItems: 'center',
    borderRadius: 10,
  },
  description: {
    fontSize: 13,
    fontFamily: fonts.JakartaRegular,
    color: '#303030',
    marginTop: 10,
    lineHeight: 18,
  },
  title: {
    fontSize: 15,
    fontFamily: fonts.JakartaBold,
    color: '#303030',
  },
  readMoreBtn: {
    marginTop: 10,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 4,
  },
  readMoreText: {
    fontSize: 13,
    color: '#167E98',
    fontFamily: fonts.OpenSansSemiBold,
    marginBottom: 2,
  },
  rightArrorIcon: {
    height: 10,
    width: 10,
    objectFit: 'contain',
  },
});

export default BlogCard;
