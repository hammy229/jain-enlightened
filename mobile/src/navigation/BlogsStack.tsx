import { createStackNavigator } from '@react-navigation/stack';
import BlogsScreen from '../screens/BlogsScreen';
import BlogDetailsScreen from '../screens/BlogDetailsScreen';

const Stack = createStackNavigator();

const BlogsStack = () => {
  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      <Stack.Screen name="BlogsScreen" component={BlogsScreen} />
      <Stack.Screen name="BlogDetails" component={BlogDetailsScreen} />
    </Stack.Navigator>
  );
};

export default BlogsStack;
