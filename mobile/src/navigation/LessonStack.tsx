import React from 'react';
import { createStackNavigator } from '@react-navigation/stack';
import LessonsScreen from '../screens/LessonsScreen';
import LessonDetailsScreen from '../screens/LessonDetailsScreen';

const Stack = createStackNavigator();

const LessonStack = () => {
  return (
    <Stack.Navigator
      screenOptions={{ headerShown: false }}
      initialRouteName="Lesson">
      <Stack.Screen name="Lesson" component={LessonsScreen} />
      <Stack.Screen name="LessonDetails" component={LessonDetailsScreen} />
    </Stack.Navigator>
  );
};

export default LessonStack;
