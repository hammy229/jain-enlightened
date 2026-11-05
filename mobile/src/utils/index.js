import { Linking } from 'react-native';

export const handleLink = async (url) => {
  try {
    if (!url) {
      console.log('URL is not provided');
      return;
    }

    // Check URL format
    const isPhone = url.startsWith('tel:');
    const isEmail = url.startsWith('mailto:');
    const isMap =
      url.startsWith('geo:') ||
      url.startsWith('maps:') ||
      url.includes('google.com/maps');

    // Handle Map URLs for iOS and Android
    if (isMap) {
      const mapLink = Platform.select({
        ios: url.startsWith('maps:') ? url : `maps:0,0?q=${url}`,
        android: url.startsWith('geo:') ? url : `geo:0,0?q=${url}`,
      });
      url = mapLink;
    }

    const supported = await Linking.openURL(url);

    if (supported) {
      await Linking.openURL(url);
    } else {
      console.log(`Don't know how to open this URL: ${url}`);
    }
  } catch (error) {
    console.error('An error occurred', error);
  }
};

export const splitHeading = (text) => {
  const words = text.split(' ');
  const mainText = words.slice(0, words.length - 1).join(' ');
  const highlightedText = words[words.length - 1];
  return { mainText, highlightedText };
};
