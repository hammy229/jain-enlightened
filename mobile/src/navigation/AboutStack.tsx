import { createStackNavigator } from '@react-navigation/stack';
import AboutScreen from '../screens/AboutScreen';
import StrategicGoalsScreen from '../screens/StrategicGoalsScreen';
import FounderMessageScreen from '../screens/FounderMessageScreen';
import GuidanceScreen from '../screens/GuidanceScreen';
import AcknowledgementScreen from '../screens/AcknowledgementScreen';

const Stack = createStackNavigator();

const AboutStack = () => {
  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      <Stack.Screen name="AboutUs" component={AboutScreen} />
      <Stack.Screen name="StrategicGoals" component={StrategicGoalsScreen} />
      <Stack.Screen name="FounderMessage" component={FounderMessageScreen} />
      <Stack.Screen name="Guidance" component={GuidanceScreen} />
      <Stack.Screen name="Acknowledgement" component={AcknowledgementScreen} />
    </Stack.Navigator>
  );
};

export default AboutStack;
