import mockAuthDefault, { useAuth as useMockAuth, mockUsers as mockUsersMock, isMockAuth as mockFlag } from './mockAuth';
import realAuthDefault, { useAuth as useRealAuth, isMockAuth as realFlag } from './realAuth';

const isDev = import.meta.env.MODE !== 'production';
const defaultMock = isDev ? 'true' : 'false';
const USE_MOCK = String(import.meta.env.VITE_USE_MOCK_AUTH ?? defaultMock) === 'true';

const authImpl = USE_MOCK ? mockAuthDefault : realAuthDefault;

export default authImpl;
export const useAuth = USE_MOCK ? useMockAuth : useRealAuth;
export const mockUsers = USE_MOCK ? mockUsersMock : {};
export const isMockAuth = USE_MOCK ? mockFlag : realFlag;