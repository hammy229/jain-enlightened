import axios from 'axios';

// Bootstrap endpoint that returns the API base URL. Replace with your own domain.
const BOOTSTRAP_URL = 'https://your-domain.com/api/general-data';

export const fetchBaseUrl = async () => {
  try {
    const response = await axios.get(BOOTSTRAP_URL);
    return response.data.data.base_url.live;
    // return response.data.data.base_url.staging;
    // return response.data.data.base_url.testing;
  } catch (error) {
    console.log('Error with fetchBaseUrl: ', error);
    return null;
  }
};

export const fetchAppVersion = async (url) => {
  try {
    const response = await axios.get(`${url}/api/app-update`);
    return response.data.data.app_latest_version;
  } catch (error) {
    console.log('Errror with fetchAppVersion: ', error);
  }
};

export const fetchStoreLinks = async (url) => {
  try {
    const response = await axios.get(`${url}/api/store-link`);
    return response.data.data.store_link;
  } catch (error) {
    console.log('Errror with fetchAppVersion: ', error);
  }
};

export const fetchBlogs = async (url) => {
  try {
    const response = await axios.get(`${url}/api/blogs`);
    return response.data.data.blogs;
  } catch (error) {
    console.log('Errror with fetchBlogs: ', error);
  }
};

export const fetchBlogDetails = async (url, id) => {
  try {
    const response = await axios.get(`${url}/api/blog/${id}`);
    return response.data.data;
  } catch (error) {
    console.log('Error with fetchBlogDetails: ', error);
  }
};

export const fetchImpacts = async (url) => {
  try {
    const response = await axios.get(`${url}/api/impacts`);
    return response.data.data.impacts;
  } catch (error) {
    console.log('Error with fetchImpacts: ', error);
  }
};

export const fetchLessons = async (url) => {
  try {
    const response = await axios.get(`${url}/api/lessons`);
    return response.data.data;
  } catch (error) {
    console.log('Error with fetchLessons: ', error);
  }
};

export const fetchLessonDetails = async (url, id) => {
  try {
    const response = await axios.get(`${url}/api/lesson/${id}`);
    return response.data.data;
  } catch (error) {
    console.log('Error with fetchBlogDetails: ', error);
  }
};

export const fetchPodcasts = async (url) => {
  try {
    const response = await axios.get(`${url}/api/podcasts`);
    return response.data.data.podcasts;
  } catch (error) {
    console.log('Error with fetchPodcasts: ', error);
  }
};

export const fetchTermsCondition = async (url) => {
  try {
    const response = await axios.get(`${url}/api/term-and-condition`);
    return response.data.data.terms_and_condition[0].description;
  } catch (error) {
    console.log('Error with fetchTermsCondition: ', error);
  }
};

export const fetchPrivacyPolicy = async (url) => {
  try {
    const response = await axios.get(`${url}/api/privacy-policy`);
    return response.data.data.privacy_policy[0].description;
  } catch (error) {
    console.log('Error with fetchPrivacyPolicy: ', error);
  }
};

export const fetchFoundersDetails = async (url) => {
  try {
    const response = await axios.get(`${url}/api/founder-message`);
    return response.data.data.founder_message;
  } catch (error) {
    console.log('Error with fetchFoundersDetails: ', error);
  }
};

export const fetchHelpUsGrow = async (url) => {
  try {
    const response = await axios.get(`${url}/api/help-us-grow`);
    return response.data.data.bank_details[0];
  } catch (error) {
    console.log('Error with fetchHelpUsGrow: ', error);
  }
};

export const fetchAboutUsDetails = async (url) => {
  try {
    const response = await axios.get(`${url}/api/about-us`);
    return response.data.data;
  } catch (error) {
    console.log('Error with fetchAboutUsDetails: ', error);
  }
};

export const fetchContactUsDetails = async (url) => {
  try {
    const response = await axios.get(`${url}/api/contact-us`);
    return response.data.data.contacts;
  } catch (error) {
    console.log('Error with fetchContactUsDetails: ', error);
  }
};

export const fetchGallery = async (url, slug) => {
  try {
    const response = await axios.get(`${url}/api/galleries/${slug}`);
    return response.data.data.galleries;
  } catch (error) {
    console.log('Error with fetchGallery: ', error);
  }
};

export const fetchResearch = async (url, slug) => {
  try {
    const response = await axios.get(`${url}/api/researches/${slug}`);
    return response.data.data.researches;
  } catch (error) {
    console.log('Error with fetchResearch: ', error);
  }
};

export const fetchHomeDetails = async (url) => {
  try {
    const response = await axios.get(`${url}/api/home`);
    return response.data.data;
  } catch (error) {
    console.log('Error with fetchResearch: ', error);
  }
};

export const addContactUs = async (url, formData) => {
  try {
    const response = await axios.post(`${url}/api/contact-us/store`, formData, {
      headers: {
        'Content-Type': 'application/json',
      },
    });
    return response.data;
  } catch (error) {
    console.log('Error while adding contactUs: ', error);
    return null;
  }
};

export const addInternship = async (url, formData) => {
  try {
    const response = await axios.post(
      `${url}/api/internship-opportunity/store`,
      formData,
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    );
    return response.data;
  } catch (error) {
    console.log('Error while adding Internship :', error);
    return null;
  }
};

export const fetchIntershipOpportunity = async (url) => {
  try {
    const response = await axios.get(`${url}/api/internship-opportunity`);
    return response.data;
  } catch (error) {
    console.log('Error with fetchIntershipOpportunity: ', error);
  }
};
