interface AppConstType {
  APP_NAME: string;
  VERSION: string;
}

interface APIEndpoints {
  LOGIN: string;
  // Add other endpoints here
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
  BASE_URL: 'https://wordpress.betaplanets.com/wp-json/',
  ENDPOINTS: {
    LOGIN: 'jwt-auth/v1/token',
    // Add other endpoints here as needed
  }
};
