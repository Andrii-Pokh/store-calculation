import http from "../http-common";

class CalculationService {
    getNasdaq(): Promise<any> {
        return http.get("/nasdaq");
    }

    postForm(data: any): Promise<any> {
        return http.post("/rapid", data);
    }

    sendEmail(data: any): Promise<any> {
        return http.post("/mail", data);
    }

    getHistoricalData(): Promise<any> {
        return http.get("/historical-data");
    }
}

export default new CalculationService();