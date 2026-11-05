import {
  View,
  Text,
  Image,
  StyleSheet,
  Pressable,
  Platform,
} from 'react-native';
import React from 'react';
import { RightArrowBlue } from '../../assets/images';
import { RouteProp, useNavigation } from '@react-navigation/native';

type LessonCardRouteProp = RouteProp<{
  lessonDetails: { id: number };
}>;

interface LessonCardProps {
  route: LessonCardRouteProp;
  id: number;
  title: string;
  description: string;
  image: string;
  index: number;
  totalCount: number;
}

const LessonCard: React.FC<LessonCardProps> = ({
  id,
  title,
  description,
  image,
  index,
  totalCount,
}) => {
  const navigation = useNavigation();

  const handleClick = () => {
    navigation.navigate('LessonDetails', { id: id });
  };

  return (
    <Pressable
      onPress={handleClick}
      style={[
        styles.container,
        index === totalCount - 1 ? styles.noBorder : null,
      ]}>
      <Image source={{ uri: image }} style={styles.lessonImage} />
      <View style={styles.detailsContainer}>
        <Text style={styles.title}>{title}</Text>
        {/* <Text style={styles.description}>{description}</Text> */}
        {/* <HTML source={{ html: description }} /> */}
        <Text style={styles.description} numberOfLines={3} ellipsizeMode="tail">
          {description}
        </Text>
      </View>
      <View style={styles.arrowBox}>
        <Image source={RightArrowBlue} style={styles.arrow} />
      </View>
    </Pressable>
  );
};

const styles = StyleSheet.create({
  container: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'flex-start',
    gap: 15,
    paddingTop: 15,
    paddingBottom: 15,
    borderBottomWidth: 1,
    borderBottomColor: '#B2ADAA',
    borderStyle: Platform.OS === 'ios' ? 'solid' : 'dashed',
  },
  noBorder: {
    borderBottomWidth: 0,
  },
  lessonImage: {
    height: 95,
    width: 95,
    objectFit: 'cover',
    borderRadius: 10,
  },
  detailsContainer: {
    flex: 1,
    justifyContent: 'space-between',
    gap: 5,
  },
  title: {
    color: '#303030',
    fontSize: 15,
    lineHeight: 25,
    fontWeight: '700',
  },
  description: {
    color: '#000',
    fontSize: 13,
    lineHeight: 18,
    fontWeight: '400',
  },
  arrowBox: {
    height: 22,
    width: 22,
    borderRadius: 4,
    backgroundColor: '#DDF7FE',
    justifyContent: 'center',
    alignItems: 'center',
  },
  arrow: {
    height: 12,
    width: 12,
    objectFit: 'contain',
  },
});

export default LessonCard;
