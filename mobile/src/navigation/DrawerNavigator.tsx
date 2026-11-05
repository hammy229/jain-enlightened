import React from 'react';
import { createDrawerNavigator } from '@react-navigation/drawer';
import HomeScreen from '../screens/HomeScreen';
import GalleryScreen from '../screens/GalleryScreen';
import CustomDrawer from '../components/CustomDrawer';
import ImpactScreen from '../screens/ImpactScreen';
import PodcastScreen from '../screens/PodcastScreen';
import ResearchScreen from '../screens/ResearchScreen';
import LessonStack from './LessonStack';
import BlogsStack from './BlogsStack';
import TermsScreen from '../screens/TermsConditionScreen';
import PrivacyPolicyScreen from '../screens/PrivacyPolicyScreen';
import HelpUsGrow from '../screens/HelpUsGrowScreen';
import ContactScreen from '../screens/ContactScreen';
import InternshipScreen from '../screens/InternshipScreen';
import StrategicGoalsScreen from '../screens/StrategicGoalsScreen';
import FounderMessageScreen from '../screens/FounderMessageScreen';
import AboutStack from './AboutStack';
import MissionScreen from '../screens/MissionScreen';
import GuidanceScreen from '../screens/GuidanceScreen';
import AcknowledgementScreen from '../screens/AcknowledgementScreen';

const Drawer = createDrawerNavigator();

const DrawerNavigator: React.FC = () => {
  return (
    <Drawer.Navigator
      drawerContent={(props) => <CustomDrawer {...props} />}
      screenOptions={{
        headerShown: false,
        drawerType: 'front',
        drawerStyle: {
          backgroundColor: 'transparent',
        },
      }}>
      <Drawer.Screen
        name="Home"
        component={HomeScreen}
        initialParams={{ screen: 'Home' }}
        options={{ title: 'Home' }}
      />
      <Drawer.Screen name="Gallery" component={GalleryScreen} />
      <Drawer.Screen
        name="LessonStack"
        component={LessonStack}
        initialParams={{ screen: 'Lessons' }}
        options={{ title: 'Lessons' }}
      />
      <Drawer.Screen
        name="Podcast"
        component={PodcastScreen}
        initialParams={{ screen: 'Podcast' }}
        options={{ title: 'Podcast' }}
      />
      <Drawer.Screen
        name="Research"
        component={ResearchScreen}
        initialParams={{ screen: 'Research' }}
        options={{ title: 'Research' }}
      />

      <Drawer.Screen name="FounderMessage" component={FounderMessageScreen} />
      <Drawer.Screen name="StrategicGoals" component={StrategicGoalsScreen} />
      <Drawer.Screen name="Impact" component={ImpactScreen} />
      <Drawer.Screen name="About" component={AboutStack} />
      <Drawer.Screen name="BlogStack" component={BlogsStack} />
      <Drawer.Screen name="Terms" component={TermsScreen} />
      <Drawer.Screen name="Privacy" component={PrivacyPolicyScreen} />
      <Drawer.Screen name="HelpUsGrow" component={HelpUsGrow} />
      <Drawer.Screen name="Contact" component={ContactScreen} />
      <Drawer.Screen name="Internship" component={InternshipScreen} />
      <Drawer.Screen name="Mission" component={MissionScreen} />
      <Drawer.Screen name="Guidance" component={GuidanceScreen} />
      <Drawer.Screen name="Acknowledgement" component={AcknowledgementScreen} />
    </Drawer.Navigator>
  );
};

export default DrawerNavigator;
