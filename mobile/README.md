# Jain Enlightened

**Jain Enlightened** is a cross-platform mobile application developed using **React Native** to spread the knowledge and teachings of Jainism. It provides various resources such as lessons, podcasts, blogs, research, and more. The app also features a chatbot and pull-to-refresh functionality on several pages.

## Table of Contents

- [App Features](#app-features)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [State Management](#state-management)
- [Navigation](#navigation)
- [API Integration](#api-integration)
- [Pull to Refresh](#pull-to-refresh)
- [Fastbots Chatbot Integration](#fastbots-chatbot-integration)

## App Features

The app includes the following sections:

- **Home Page**
- **Lessons Page**
- **Podcasts**
- **Research Page**
- **Blogs Page**
- **Contact Us**
- **Internship Opportunities**
- **Help Us Grow**
- **About Us**
- **Gallery**
- **Impact**
- **Terms & Conditions**
- **Privacy Policy**
- Integrated **Fastbots Chatbot** using WebView

Pages with **Pull to Refresh** functionality:

- Home
- About Us
- Lessons
- Blogs
- Podcasts
- Research
- Help Us Grow
- Impact
- Gallery

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/hammy229/jain-enlightened.git
   ```

2. Navigate to the project directory:

   ```bash
   cd Jain_Enlightened_Mobile_App
   ```

3. Install the necessary dependencies:

   ```bash
   npm install
   ```

4. Run the app:

   - For Android:

     ```bash
     npx react-native run-android
     ```

   - For iOS:

     ```bash
     cd ios
     pod install
     cd ..
     npx react-native run-ios
     ```

## Project Structure

```bash
├── api
│   └── api.js           # Contains all API calls
├── assets
│   └── fonts            # Contains project fonts
│   └── images           # Contains project iamges
│   └── styles           # Contains globalstyles & colors
├── components
│   └── buttons          # Buttons
│   └── cards            # Cards
│   └── modal            # Modals
│   └── ...              # Rest components
├── screens
│   ├── HomeScreen.js            # Home page
│   ├── LessonsScreen.js         # Lessons page
│   ├── PodcastScreen.js        # Podcasts page
│   ├── ResearchScreen.js        # Research page
│   ├── BlogsScreen.js           # Blogs page
│   ├── ContactScreen.js       # Contact us page
│   └── ...                # Other pages
├── navigation
│   ├── AboutStack.js
│   ├── BlogsStack.js
│   ├── DrawerNavigator.js
│   ├── LessonStack.js
│   └── MainNavigator.js
├── context
│   └── ActiveRouteContext.js     # Context to manage the current route
```

## Navigation

The app uses **Drawer Navigation** and **Stack Navigation** for route management. Additionally, a custom bottom navigation is implemented on all pages except the **Help Us Grow**, **Contact Us**, and **Internship Opportunities** pages.

### Drawer Navigation

The drawer provides access to different sections of the app.

### Bottom Navigation

The bottom navigation bar is styled like the drawer navigation but is present on most pages for easier access.

## API Integration

All API calls are centralized in a single file located at `api/api.js`. The APIs are called from the respective pages where needed.

For example, the **Home** page fetches data as follows:

```javascript
import { fetchLessons } from '../api/api';

const getLessons = async () => {
  try {
    const url = await AsyncStorage.getItem('baseUrl');

    if (url) {
      const response = await fetchLessons(url);
      setLessons(response.lessons);
      setLanguage(response.languages);
    } else {
      console.log('Base URL not found in AsyncStorage');
    }
  } catch (error) {
    console.log('Error fetching base URL or blogs: ', error);
  } finally {
    setLoading(false);
  }
};
```

## Pull to Refresh

Pull to Refresh functionality is implemented on nine pages:

- Home
- About Us
- Lessons
- Blogs
- Podcasts
- Research
- Help Us Grow
- Impact
- Gallery

### Example usage:

```javascript
<ScrollView
  refreshControl={
    <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
  }>
  {/* Page content */}
</ScrollView>
```

## Fastbots Chatbot Integration

The **Fastbots Chatbot** is integrated using **WebView**, allowing users to interact with the chatbot directly within the app.

### Example usage:

```javascript
import { WebView } from 'react-native-webview';

<WebView
  source={{
    uri: 'https://app.fastbots.ai/',
  }}
  style={styles.webView}
/>;
```
