import { Text, Image, Pressable } from 'react-native';
import React from 'react';
import { RightArrowBlack, RightArrowBlue } from '../../assets/images';
import { useNavigation } from '@react-navigation/native';
import { globalStyles } from '../../assets/styles/globalStyles';

interface RightArrowButtonProps {
  title: string;
  color: string;
  route: string;
  section: string;
  pageDetails: any;
}

const RightArrowButton: React.FC<RightArrowButtonProps> = ({
  title,
  color,
  route,
  section,
  pageDetails,
}) => {
  const navigation = useNavigation();
  const handlePress = () => {
    if (route) {
      navigation.navigate(route, { section, pageDetails });
    }
  };

  return (
    <Pressable onPress={handlePress} style={globalStyles.rightArrowBtn}>
      <Text style={[globalStyles.rightArrowBtnTextBlack, { color: color }]}>
        {title}
      </Text>
      <Image
        source={color === '#000' ? RightArrowBlack : RightArrowBlue}
        style={globalStyles.rightArrowBtnArrow}
      />
    </Pressable>
  );
};

export default RightArrowButton;
