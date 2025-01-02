interface AppConstType {
  APP_NAME: string;
  VERSION: string;
}

interface APIEndpoints {
  LOGIN: string;
  MOBILEAPI: string;
  GET_PROFILE: string;
  UPDATE_PROFILE: string;
  CHANGE_PASSWORD: string;
  GET_ABOUTUS: string;
  DELETE_USER: string;
  GET_EVENTS: string;
  GET_AI_API_URL: string;
  GET_AI_WELCOME: string;
  SAVE_AI_QNA: string;
  ASK_BLUESTONEAI: string;
  GET_AI_CREDENTIALS: string;
}

interface APIConfig {
  BASE_URL: string;
  ENDPOINTS: APIEndpoints;
}

export const AppConst: AppConstType = {
  APP_NAME: 'LA React Native',
  VERSION: '1.0.0',
};

export const API: APIConfig = {
  BASE_URL: 'https://wordpress.betaplanets.com/',
  ENDPOINTS: {
    LOGIN: 'wp-json/jwt-auth/v1/token',
    MOBILEAPI: 'wp-json/mobileapi/v1',
    GET_PROFILE: 'wp-json/mobileapi/v1/getProfile',
    UPDATE_PROFILE: 'wp-json/mobileapi/v1/updateProfile',
    CHANGE_PASSWORD: 'updatePassword',
    GET_ABOUTUS: 'get_aboutus',
    DELETE_USER: 'delete_user',
    GET_EVENTS: 'wp-json/mobileapi/v1/getEvents',
    GET_AI_API_URL: 'get_ai_api_url',
    GET_AI_WELCOME: 'get_ai_welcome',
    SAVE_AI_QNA: 'save_ai_qna',
    ASK_BLUESTONEAI: 'ask_bluestoneai',
    GET_AI_CREDENTIALS: 'get_ai_credentials'
  }
};
