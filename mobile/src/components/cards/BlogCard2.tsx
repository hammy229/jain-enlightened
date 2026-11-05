import { View, Text, Image, StyleSheet, Pressable } from 'react-native';
import React from 'react';
import { fonts } from '../../assets/fonts';
import { RouteProp, useNavigation } from '@react-navigation/native';
import { User } from '../../assets/images';
import { colors } from '../../assets/styles/colors';

type BlogCard2RouteProp = RouteProp<{
  blogDetails: { id: number };
}>;

interface BlogCard2Props {
  route: BlogCard2RouteProp;
  image: string;
  title: string;
  author: string;
  id: number;
}

const BlogCard: React.FC<BlogCard2Props> = ({ image, title, author, id }) => {
  const navigation = useNavigation();
  return (
    <Pressable
      onPress={() => navigation.navigate('BlogDetails', { id: id })}
      style={styles.padRight}>
      <View style={styles.cardContainer}>
        <Image source={{ uri: image }} style={styles.image} />
        <View style={[styles.textContainer]}>
          <Text style={styles.title} numberOfLines={1} ellipsizeMode="tail">
            {title}
          </Text>
          <View
            style={{
              marginTop: 5,
              flexDirection: 'row',
              alignItems: 'center',
              gap: 5,
              width: '80%',
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
              style={{ fontFamily: fonts.OpenSansSemiBold, fontSize: 13 }}
              numberOfLines={1}
              ellipsizeMode="tail">
              {author}
            </Text>
          </View>
        </View>
      </View>
    </Pressable>
  );
};

const styles = StyleSheet.create({
  padRight: {
    marginLeft: 5,
    marginRight: 10,
    marginBottom: 10,
  },
  cardContainer: {
    borderRadius: 8,
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.23,
    shadowRadius: 2.62,

    elevation: 4,
    backgroundColor: '#fff',
    padding: 2,
    width: 224,
  },
  image: {
    height: 235,
    width: 220,
    borderRadius: 10,
  },
  textContainer: {
    padding: 6,
  },
  title: {
    fontSize: 14,
    color: '#222222',
    fontFamily: fonts.JakartaBold,
  },
  authorText: {
    fontSize: 12,
    color: '#5C5C5C',
    fontFamily: fonts.OpenSansSemiBold,
  },
});

export default BlogCard;
