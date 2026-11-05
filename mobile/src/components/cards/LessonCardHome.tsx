import { View, Text, Image, StyleSheet, Pressable } from 'react-native';
import React from 'react';
import { RouteProp, useNavigation } from '@react-navigation/native';

type LessonCardRouteProp = RouteProp<{
  lessonDetails: { id: number };
}>;

interface LessonCardProps {
  route: LessonCardRouteProp;
  id: number;
  title: string;
  image: string;
}

const LessonCardHome: React.FC<LessonCardProps> = ({ id, title, image }) => {
  const navigation = useNavigation();

  return (
    <Pressable
      // onPress={() =>
      //   navigation.navigate('LessonStack', {
      //     screen: 'Lesson',
      //     params: { id: id },
      //   })
      // }
      onPress={() =>
        navigation.reset({
          index: 0,
          routes: [
            {
              name: 'LessonStack',
              params: { screen: 'Lesson', params: { id: id } },
            },
          ],
        })
      }
      style={styles.padRight}>
      <View style={styles.cardContainer}>
        <Image source={{ uri: image }} style={styles.image} />
        <View style={styles.textContainer}>
          <Text style={styles.text} numberOfLines={1} ellipsizeMode="tail">
            {title}
          </Text>
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
    height: 220,
    width: 155,
    backgroundColor: '#fff',
    padding: 2,
  },
  image: {
    height: '82%',
    width: '100%',
    borderRadius: 10,
  },
  textContainer: {
    padding: 6,
  },
  text: {
    fontSize: 14,
    fontWeight: '600',
    color: '#323643',
  },
});

export default LessonCardHome;
