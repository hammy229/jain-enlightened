import { View, Text, StyleSheet } from 'react-native';
import React from 'react';
import LinearGradient from 'react-native-linear-gradient';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import BackBtn from './BackBtn';
import DrawerOpenBtn from './DrawerOpenBtn';

interface SecondarPageHeaderProps {
  title: string;
  borderRadius: number;
}

const SecondaryPageHeader: React.FC<SecondarPageHeaderProps> = ({
  title,
  borderRadius = 14,
}) => {
  const insets = useSafeAreaInsets();

  return (
    <LinearGradient
      colors={['#236272', '#236272', '#1D515E']}
      start={{ x: 0, y: 0 }}
      end={{ x: 0, y: 1 }}
      style={[
        styles.container,
        {
          paddingTop: insets.top,
          borderBottomRightRadius: borderRadius,
          borderBottomLeftRadius: borderRadius,
        },
      ]}>
      <BackBtn />
      <View style={styles.titleContainer}>
        <Text style={styles.text}>{title}</Text>
      </View>
      <DrawerOpenBtn />
    </LinearGradient>
  );
};

const styles = StyleSheet.create({
  container: {
    paddingHorizontal: 15,
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingBottom: 20,
  },
  titleContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  text: {
    color: '#fff',
    fontSize: 16,
    fontWeight: '600',
  },
});

export default SecondaryPageHeader;
